<?php
/**
 * Mega Menu
 * @package Topper Pack
 * @since 1.0.0
 */
namespace TopperPack\Includes\Mega_Menu;

use TopperPack\Includes\TOPPPA_Helper;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class TOPPPA_Nav_Menu_Walker extends \Walker_Nav_Menu {
	private $settings = null;

	private $is_mobile_menu = null;

	public function __construct($widget_settings = false, $is_mobile_menu = false) {

		add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);

		add_action('wp_ajax_handle_live_editor', array($this, 'handle_live_editor'));

		add_action('wp_ajax_get_topppa_menu_item_settings', array($this, 'get_topppa_menu_item_settings'));
		add_action('wp_ajax_save_topppa_menu_item_settings', array($this, 'save_topppa_menu_item_settings'));
		add_action('wp_ajax_save_topppa_mega_item_content', array($this, 'save_topppa_mega_item_content'));

		add_action('wp_ajax_check_temp_validity', array($this, 'check_temp_validity'));

		$this->settings = $widget_settings;

		$this->is_mobile_menu = $is_mobile_menu;
	}

	public function check_temp_validity() {

		check_ajax_referer('topppa-live-editor', 'security');

		if (! isset($_POST['templateID'])) {
			wp_send_json_error('template ID is not set');
		}

		if (! current_user_can('manage_options')) {
			wp_send_json_error('Insufficient user permission');
		}

		$temp_id   = isset($_POST['templateID']) ? sanitize_text_field(wp_unslash($_POST['templateID'])) : '';
		$temp_type = isset($_POST['tempType']) ? sanitize_text_field(wp_unslash($_POST['tempType'])) : '';

		if ('loop' === $temp_type) {
			/** @var LoopDocument $document */
			$template_content = PluginPro::elementor()->documents->get($temp_id);
		} else {
			$template_content = $this->template_instance->get_template_content($temp_id, true);
		}

		if (empty($template_content) || ! isset($template_content)) {

			$res = wp_delete_post($temp_id, true);

			if (! is_wp_error($res)) {
				$res = 'Template Deleted.';
			}
		} else {
			$res = 'Template Has Content.';
		}

		wp_send_json_success($res);
	}

	public function save_topppa_mega_item_content() {

		check_ajax_referer('topppa-live-editor', 'security');

		if (! current_user_can('edit_theme_options')) {
			wp_send_json_error('Insufficient user permission');
		}

		if (! isset($_POST['template_id'])) {
			wp_send_json_error('template id is not set!');
		}

		if (! isset($_POST['menu_item_id'])) {
			wp_send_json_error('item id is not set!');
		}

		$item_id = sanitize_text_field(wp_unslash($_POST['menu_item_id']));
		$temp_id = sanitize_text_field(wp_unslash($_POST['template_id']));

		update_post_meta($item_id, 'topppa_mega_content_temp', $temp_id);

		wp_send_json_success('Item Mega Content Saved');
	}

	public function save_topppa_menu_item_settings() {

		check_ajax_referer('topppa-menu-nonce', 'security');

		if (! current_user_can('manage_options')) {
			wp_send_json_error('User is not authorized!');
		}

		if (! isset($_POST['settings'])) {
			wp_send_json_error('Settings are not set!');
		}

		$settings = array_map(
			function ($setting) {
				return htmlspecialchars($setting, ENT_QUOTES);
			},
			wp_unslash($_POST['settings']) // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		);

		update_post_meta($settings['item_id'], 'topppa_megamenu_item_meta', wp_json_encode($settings, JSON_UNESCAPED_UNICODE));

		wp_send_json_success($settings);
	}

	public function get_topppa_menu_item_settings() {

		check_ajax_referer('topppa-menu-nonce', 'security');

		if (! current_user_can('manage_options')) {
			wp_send_json_error('User is not authorized!');
		}

		if (! isset($_POST['item_id'])) {
			wp_send_json_error('Settings are not set!');
		}

		$item_id       = sanitize_text_field(wp_unslash($_POST['item_id']));
		$item_settings = json_decode(get_post_meta($item_id, 'topppa_megamenu_item_meta', true));

		wp_send_json_success($item_settings);
	}

	public function handle_live_editor() {

		check_ajax_referer('topppa-live-editor', 'security');

		if (! isset($_POST['key'])) {
			wp_send_json_error();
		}

		$post_name  = 'topppa-dynamic-temp-' . sanitize_text_field(wp_unslash($_POST['key']));
		$temp_type  = isset($_POST['type']) ? sanitize_text_field(wp_unslash($_POST['type'])) : false;
		$meta_input = array(
			'_elementor_edit_mode'     => 'builder',
			'_elementor_template_type' => 'page',
			'_wp_page_template'        => 'elementor_canvas',
		);

		if ('loop' === $temp_type) {
			$meta_input = array(
				'_elementor_edit_mode'     => 'builder',
				'_elementor_template_type' => 'loop-item',
			);
		} elseif ('grid' === $temp_type) {
			$meta_input = array(
				'_elementor_edit_mode'     => 'builder',
				'_elementor_template_type' => 'topppa-grid',
			);
		}

		$post_title = '';
		$args       = array(
			'post_type'              => 'elementor_library',
			'name'                   => $post_name,
			'post_status'            => 'publish',
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'posts_per_page'         => 1,
		);

		$post = get_posts($args);

		if (empty($post)) {

			$key        = sanitize_text_field(wp_unslash($_POST['key']));
			$post_title = 'TOPPPA Template | #' . substr(md5($key), 0, 4);

			$params = array(
				'post_content' => '',
				'post_type'    => 'elementor_library',
				'post_title'   => $post_title,
				'post_name'    => $post_name,
				'post_status'  => 'publish',
				'meta_input'   => $meta_input,
			);

			$post_id = wp_insert_post($params);
		} else {
			$post_id    = $post[0]->ID;
			$post_title = $post[0]->post_title;
		}

		$edit_url = get_admin_url() . '/post.php?post=' . $post_id . '&action=elementor';

		$result = array(
			'url'   => $edit_url,
			'id'    => $post_id,
			'title' => $post_title,
		);

		wp_send_json_success($result);
	}

	public function admin_enqueue_scripts() {
		wp_enqueue_style('wp-color-picker');

		wp_enqueue_style(
			'jquery-fonticonpicker',
			TOPPPA_INC_URL . 'mega-menu/assets/css/jquery-fonticonpicker.css',
			[],
			TOPPPA_VER,
			'all'
		);

		wp_enqueue_style(
			'menu-editor',
			TOPPPA_INC_URL . 'mega-menu/assets/css/menu-editor.css',
			[],
			TOPPPA_VER,
			'all'
		);

		wp_enqueue_script(
			'jquery-fonticonpicker',
			TOPPPA_INC_URL . 'mega-menu/assets/js/jquery-fonticonpicker.js',
			['jquery'],
			TOPPPA_VER,
			true
		);

		wp_enqueue_script(
			'topppa-icon-list',
			TOPPPA_INC_URL . 'mega-menu/assets/js/icons-list.js',
			[],
			TOPPPA_VER,
			true
		);

		wp_enqueue_script(
			'mega-content-handler',
			TOPPPA_INC_URL . 'mega-menu/assets/js/mega-content-handler.js',
			['jquery'],
			TOPPPA_VER,
			true
		);

		wp_enqueue_script(
			'menu-editor',
			TOPPPA_INC_URL . 'mega-menu/assets/js/menu-editor.js',
			array('jquery', 'wp-color-picker'),
			TOPPPA_VER,
			true
		);

		$topppa_menu_localized = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('topppa-menu-nonce'),
		);

		$menu_content_localized = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('topppa-live-editor'),
		);

		wp_localize_script('mega-content-handler', 'topppaMegaContent', $menu_content_localized);
		wp_localize_script('menu-editor', 'topppaMenuSettings', $topppa_menu_localized);

		// Only include the mega menu settings template on specific admin pages
		// This prevents "headers already sent" errors on the setup wizard
		$current_screen = get_current_screen();
		$allowed_pages = array('nav-menus', 'appearance_page_nav-menus');
		
		if ($current_screen && in_array($current_screen->id, $allowed_pages)) {
			include_once TOPPPA_INC_PATH . 'mega-menu/nav-menu-settings.php';
		}
	}

	public function get_item_postmeta($item_id) {

		$defauls = array(
			'item_id'                 => '',
			'item_icon'               => '',
			'item_badge'              => '',
			'item_depth'              => '',
			'item_badge_bg'           => '',
			'item_icon_type'          => '',
			'item_lottie_url'         => '',
			'item_icon_color'         => '',
			'item_badge_color'        => '',
			'mega_content_pos'        => '',
			'mega_content_width'      => '',
			'mega_content_enabled'    => '',
			'full_width_mega_content' => '',
		);

		$item_meta = array_merge($defauls, (array) json_decode(get_post_meta($item_id, 'topppa_megamenu_item_meta', true)));

		return (object) $item_meta;
	}

	public function get_mega_content_id($item_id) {
		return get_post_meta($item_id, 'topppa_mega_content_temp', true);
	}

	public function get_default_submenu_icon() {
		if ($this->is_mobile_menu) {
			return 'fas fa-angle-down';
		}

		$icon   = 'fas fa-angle-right';
		$layout = $this->settings['topppa_nav_menu_layout'];

		switch ($layout) {
			case 'hor':
				if (is_rtl()) {
					$icon = 'fas fa-angle-left';
				}
				break;

			case 'slide':
			case 'dropdown':
				$icon = 'fas fa-angle-down';
				break;

			case 'ver':
				$icon = 'fas fa-angle-' . $this->settings['topppa_nav_ver_submenu'];
				break;
		}

		return $icon;
	}

	public function start_lvl(&$output, $depth = 0, $args = null) {
		if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}

		$indent = str_repeat($t, $depth);

		$classes = array('topppa-sub-menu');

		$class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$output .= "{$n}{$indent}<ul$class_names>{$n}";
	}

	public function end_lvl(&$output, $depth = 0, $args = null) {
		if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent  = str_repeat($t, $depth);
		$output .= "$indent</ul>{$n}";
	}

	public function start_el(&$output, $data_object, $depth = 0, $args = [], $current_object_id = 0) {

		$settings = $this->settings;
		$menu_item = $data_object;

		if (is_null($menu_item)) {
			return;
		}

		$item_meta = $this->get_item_postmeta($menu_item->ID);

		if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}

		$indent = ($depth) ? str_repeat($t, $depth) : '';

		$classes = empty($menu_item->classes) ? array() : (array) $menu_item->classes; // has default classes.

		$classes[] = 'topppa-nav-menu-item';

		if (0 < $depth) {
			$classes[] = 'topppa-sub-menu-item';
		}

		if ('true' == $item_meta->mega_content_enabled) {
			$classes[] = 'topppa-mega-nav-item menu-item-has-children';

			if ('default' === $item_meta->mega_content_pos) {
				$classes[] = 'topppa-mega-item-static';
			}
		}

		$is_anchor = false !== strpos($menu_item->url, '#');

		if (! $is_anchor && in_array('current-menu-item', $classes, true)) {
			$classes[] = 'topppa-active-item';
		}

		if ($is_anchor) { // the active class will be added via js.
			$classes[] = 'topppa-item-anchor';
		}

		if (! empty($item_meta->item_badge)) {
			$classes[] = 'has-topppa-badge';

			$badge_effect = $settings['sub_badge_hv_effects'];

			if (0 < $depth && '' !== $badge_effect) {
				$classes[] = 'topppa-badge-' . $badge_effect;
			}
		}

		$args = apply_filters('nav_menu_item_args', $args, $menu_item, $depth);
		$class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $menu_item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		$id = apply_filters('nav_menu_item_id', 'topppa-nav-menu-item-' . $menu_item->ID, $menu_item, $args, $depth); // change the default id.
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$full_width = 'true' == $item_meta->full_width_mega_content ? ' data-full-width="true"' : '';

		$output .= $indent . '<li' . $id . $class_names . $full_width . '>';
		$atts           = array();
		$atts['title']  = ! empty($menu_item->attr_title) ? $menu_item->attr_title : '';
		$atts['target'] = ! empty($menu_item->target) ? $menu_item->target : '';

		if ('_blank' === $menu_item->target && empty($menu_item->xfn)) {

			$atts['rel'] = 'noopener';
		} else {

			$atts['rel'] = $menu_item->xfn;
		}

		$atts['href']         = ! empty($menu_item->url) ? $menu_item->url : '';
		$atts['aria-current'] = $menu_item->current ? 'page' : '';
		$is_parent = in_array('menu-item-has-children', $classes, true) || 'true' == $item_meta->mega_content_enabled;
		$is_toggle = in_array($settings['topppa_nav_menu_layout'], array('dropdown', 'slide'), true) || wp_is_mobile();

		if ($is_toggle && $is_parent) {
			$atts['data-e-disable-page-transition'] = 'true';
		}

		$atts = apply_filters('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);

		if (empty($atts['class'])) {
			$atts['class'] = 'topppa-mega-menu-link';
		} else {
			$atts['class'] .= ' topppa-mega-menu-link';
		}

		if (0 == $depth) {
			$atts['class'] .= ' topppa-mega-menu-link-parent';
		}

		$dropdown_icon = '';

		$dropdown_icon_class = '';
		$item_icon           = '';
		$item_badge          = '';
		$icon_class          = 0 < $depth ? ' topppa-sub-item-icon' : ' topppa-item-icon';
		$badge_class         = 0 < $depth ? 'topppa-sub-item-badge' : 'topppa-item-badge';

		if (in_array('menu-item-has-children', $classes, true) || 'true' == $item_meta->mega_content_enabled) {
			if (0 === $depth) {
				$dropdown_icon_class = $settings['submenu_icon']['value'];
			} else {
				$dropdown_icon_class = ! empty($settings['submenu_item_icon']['value']) ? $settings['submenu_item_icon']['value'] : $this->get_default_submenu_icon();
			}

			if (! empty($dropdown_icon_class)) {

				$dropdown_icon_class .= ' topppa-dropdown-icon';
				$dropdown_icon        = sprintf('<i class="%1$s"></i>', esc_attr($dropdown_icon_class));
			}
		}

		if ('icon' === $item_meta->item_icon_type && ! empty($item_meta->item_icon)) {
			$item_icon = sprintf('<i class="%1$s" style="color:%2$s"></i>', esc_attr($item_meta->item_icon . $icon_class), esc_attr($item_meta->item_icon_color));
		} elseif ('lottie' === $item_meta->item_icon_type && ! empty($item_meta->item_lottie_url)) {
			$item_icon = sprintf('<div class="%1$s" data-lottie-url="%2$s" data-lottie-loop="true"></div>', esc_attr($icon_class) . ' topppa-lottie-animation', esc_url($item_meta->item_lottie_url));
		}

		if (! empty($item_meta->item_badge)) {
			$item_badge = sprintf('<span class="%1$s" style="color:%2$s; background-color:%3$s;">%4$s</span>', esc_attr($badge_class), esc_attr($item_meta->item_badge_color), esc_attr($item_meta->item_badge_bg), esc_attr($item_meta->item_badge));
		}

		if (0 < $depth) {
			$atts['class'] .= ' topppa-sub-menu-link';
		}

		$attributes = '';
		foreach ($atts as $attr => $value) {
			if (is_scalar($value) && '' !== $value && false !== $value) {
				$value       = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters('the_title', $menu_item->title, $menu_item->ID);
		$title = apply_filters('nav_menu_item_title', $title, $menu_item, $args, $depth);

		$item_output  = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . $item_icon . $title . $dropdown_icon . $item_badge . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
	}

	public function end_el(&$output, $data_object, $depth = 0, $args = null) {
		if (0 === $depth) {

			$item_meta = $this->get_item_postmeta($data_object->ID);

			if ('true' == $item_meta->mega_content_enabled && class_exists('Elementor\Plugin')) {

				$temp_id       = $this->get_mega_content_id($data_object->ID);
				//$temp_instance = TOPPPA_Template_Tags::getInstance();
				$content       = TOPPPA_Helper::get_template_content($temp_id, true);
				$style         = 'width:' . $item_meta->mega_content_width;
				$output       .= sprintf('<div id="topppa-mega-content-%1$s" class="topppa-mega-content-container" style="%2$s">%3$s</div>', $data_object->ID, $style, $content);
			}
		}

		if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}

		$output .= "</li>{$n}";
	}
}

new TOPPPA_Nav_Menu_Walker();