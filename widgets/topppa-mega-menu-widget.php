<?php

namespace TopperPack\Widgets;

// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use TopperPack\Includes\Utilities;

use TopperPack\Includes\TOPPPA_Helper;
use TopperPack\Includes\Mega_Menu\TOPPPA_Nav_Menu_Walker;

if (! defined('ABSPATH')) {
	exit; // If this file is called directly, abort.
}

/**
 * Class Premium_Person.
 */
class TOPPPA_Mega_Menu_Widget extends \Elementor\Widget_Base {

	protected $template_instance;

	public function get_name() {
		return 'topppa_mega_menu';
	}

	/**
	 * Retrieve Widget Title.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return TOPPPA_EPWB . __('Mega Menu', 'topper-pack');
	}

	public function get_icon() {
		return 'eicon-mega-menu';
	}

	/**
	 * Retrieve Widget Dependent CSS.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array CSS style handles.
	 */
	public function get_style_depends() {
		return array(
			'font-awesome-5-all',
			'topppa-addons',
		);
	}

	/**
	 * Retrieve Widget Dependent JS.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array JS script handles.
	 */
	public function get_script_depends() {
		return array(
			'lottie-js',
			'topppa-headroom',
			//'topppa-menu',
		);
	}

	/**
	 * Retrieve Widget Categories.
	 *
	 * @since 1.5.1
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array('topper-pack');
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget keywords.
	 */
	public function get_keywords() {
		return array('topppa', 'widget', 'mega', 'menu', 'nav', 'navigation', 'mega menu', 'topperpack');
	}

	protected function is_dynamic_content(): bool {
		return true;
	}

	/**
	 * Get Menu List.
	 *
	 * @access private
	 * @since 4.9.3
	 *
	 * @return array
	 */
	private function get_menu_list() {

		$menus = wp_list_pluck(wp_get_nav_menus(), 'name', 'term_id');  // term_id >> index key , name >> value of that index.

		return $menus;
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://doc.topperpack.com/docs/header-footer-widgets/mega-menu/';
	}

	public function topppa_mega_menu_item_hover_effects() {
		$this->add_control(
			'pointer',
			[
				'label'          => __('Item Hover Effect', 'topper-pack'),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'none',
				'options'        => [
					'none'        => __('None', 'topper-pack'),
					'underline'   => __('Underline', 'topper-pack'),
					'overline'    => __('Overline', 'topper-pack'),
					'pro_double_line' => __('Double Line (Pro)', 'topper-pack'),
					'pro_framed'      => __('Framed (Pro)', 'topper-pack'),
					'pro_background'  => __('Background (Pro)', 'topper-pack'),
					'pro_text'        => __('Text (Pro)', 'topper-pack'),
				],
				'style_transfer' => true,
			]
		);
		Utilities::upgrade_pro_notice(
			$this,
			\Elementor\Controls_Manager::RAW_HTML,
			'topppa_mega_menu',
			'pointer',
			['pro_double_line', 'pro_framed', 'pro_background', 'pro_text']
		);
	}

	public function topppa_submenu_event() {
		$this->add_control(
			'submenu_event',
			[
				'label'       => __('Open Submenu On', 'topper-pack'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'hover',
				'render_type' => 'template',
				'options'     => [
					'hover' => __('Hover', 'topper-pack'),
					'pro_click' => __('Click (Pro)', 'topper-pack'),
				],
				'condition'   => [
					'topppa_nav_menu_layout' => ['hor', 'ver'],
				],
			]
		);
		Utilities::upgrade_pro_notice(
			$this,
			\Elementor\Controls_Manager::RAW_HTML,
			'topppa_mega_menu',
			'submenu_event',
			['pro_click']
		);
	}

	public function topppa_submenu_animation() {
		$this->add_control(
			'submenu_slide',
			[
				'label'        => __('Submenu Animation', 'topper-pack'),
				'type'         => Controls_Manager::SELECT,
				'prefix_class' => 'topppa-nav-',
				'default'      => 'none',
				'options'      => [
					'none'        => __('None', 'topper-pack'),
					'slide-up'    => __('Slide Up', 'topper-pack'),
					'slide-down'  => __('Slide Down', 'topper-pack'),
					'pro_left'  => __('Slide Left (Pro)', 'topper-pack'),
					'pro_right' => __('Slide Right (Pro)', 'topper-pack'),
				],
				'condition'    => [
					'topppa_nav_menu_layout' => ['hor', 'ver'],
				],
			]
		);
		Utilities::upgrade_pro_notice(
			$this,
			\Elementor\Controls_Manager::RAW_HTML,
			'topppa_mega_menu',
			'submenu_slide',
			['pro_left', 'pro_right']
		);
	}

	public function topppa_sub_items_badge_effects() {
		$this->add_control(
			'sub_badge_hv_effects',
			[
				'label'       => __('Badge Effects', 'topper-pack'),
				'type'        => Controls_Manager::SELECT,
				'render_type' => 'template',
				'default'     => '',
				'options'     => [
					''            => __('None', 'topper-pack'),
					'dot'         => __('Grow', 'topper-pack'),
					'expand'      => __('Expand', 'topper-pack'),
					'pro_pulse'       => __('Pulse (Pro)', 'topper-pack'),
					'pro_buzz'        => __('Buzz (Pro)', 'topper-pack'),
					'pro_sr' => __('Slide Right (Pro)', 'topper-pack'),
					'pro_sl'  => __('Slide Left (Pro)', 'topper-pack'),
				],
			]
		);
		Utilities::upgrade_pro_notice(
			$this,
			\Elementor\Controls_Manager::RAW_HTML,
			'topppa_mega_menu',
			'sub_badge_hv_effects',
			['pro_pulse', 'pro_buzz', 'pro_sr', 'pro_sl']
		);
	}

	/**
	 * Register Nav Menu Controls.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->get_menu_settings_controls();

		$this->get_menu_content_controls();

		$this->get_menu_style_controls();
	}

	/**
	 * Get menu style controls.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_menu_style_controls() {
		$this->get_ver_toggler_style();
		$this->get_menu_container_style();
		$this->get_menu_item_style();
		$this->get_menu_item_extras();
		$this->get_submenu_container_style();
		$this->get_submenu_item_style();
		$this->get_sub_menu_item_extras();
		$this->get_toggle_menu_sytle();
	}

	/**
	 * Get menu content controls.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_menu_settings_controls() {
		$this->start_controls_section(
			'topppa_nav_section',
			[
				'label' => __('Menu Settings', 'topper-pack'),
			]
		);

		$menu_list = $this->get_menu_list();
		$menu_list = ['' => __('Select Menu', 'topper-pack')] + $menu_list;

		if (!empty($menu_list)) {
			$this->add_control(
				'topppa_nav_menus',
				[
					'label'   => __('Menu', 'topper-pack'),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => $menu_list,
				]
			);
		} else {
			$this->add_control(
				'empty_nav_menu_notice',
				[
					'raw'             => '<strong>' . __('There are no menus in your site.', 'topper-pack') . '</strong><br>' .
						// translators: %s is the URL to the Menus screen in the WordPress admin.
						sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'topper-pack'), admin_url('nav-menus.php?action=edit&menu=0')),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->end_controls_section();
	}

	/**
	 * Get menu content controls.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_menu_content_controls() {
		$this->start_controls_section(
			'display_options_section',
			[
				'label' => __('Display Options', 'topper-pack'),
			]
		);

		$this->add_control(
			'load_hidden',
			[
				'label'       => __('Hide Menu Until Content Loaded', 'topper-pack'),
				'type'        => Controls_Manager::SWITCHER,
				'description' => __('This option hides the menu by default until all the content inside it is loaded.', 'topper-pack'),
				'default'     => 'yes',
			]
		);

		$this->add_control(
			'menu_heading',
			[
				'label' => __('Menu Settings', 'topper-pack'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'topppa_nav_menu_layout',
			[
				'label'        => __('Layout', 'topper-pack'),
				'type'         => Controls_Manager::SELECT,
				'prefix_class' => 'topppa-nav-',
				'options'      => [
					'hor' => 'Horizontal',
					'ver' => 'Vertical',
				],
				'render_type'  => 'template',
				'default'      => 'hor',
			]
		);

		$align_left  = is_rtl() ? 'flex-end' : 'flex-start';
		$align_right = is_rtl() ? 'flex-start' : 'flex-end';
		$align_def   = is_rtl() ? 'flex-end' : 'flex-start';

		$this->add_responsive_control(
			'topppa_nav_menu_align',
			[
				'label'     => __('Menu Alignment', 'topper-pack'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					$align_left     => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-h-align-left',
					],
					'center'        => [
						'title' => __('Center', 'topper-pack'),
						'icon'  => 'eicon-h-align-center',
					],
					$align_right    => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-h-align-right',
					],
					'space-between' => [
						'title' => __('Strech', 'topper-pack'),
						'icon'  => 'eicon-h-align-stretch',
					],
				],
				'default'   => 'center',
				'toggle'    => false,
				'selectors' => [
					'{{WRAPPER}} .topppa-main-nav-menu' => 'justify-content: {{VALUE}}',
				],
				'condition' => [
					'topppa_nav_menu_layout' => 'hor',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_nav_menu_align_ver',
			[
				'label'     => __('Menu Alignment', 'topper-pack'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					$align_left  => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __('Center', 'topper-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					$align_right => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => $align_def,
				'toggle'    => false,
				'selectors' => [
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link' => 'justify-content: {{VALUE}}',
				],
				'condition' => [
					'topppa_nav_menu_layout' => 'ver',
				],
			]
		);

		$this->add_control(
			'topppa_nav_menu_enable_flex_wrap',
			[
				'label'        => __('Enable Flex Wrap', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => __('This option allows the menu items to wrap into multiple lines if they exceed the container width.', 'topper-pack'),
				'label_on'     => __('Yes', 'topper-pack'),
				'label_off'    => __('No', 'topper-pack'),
				'return_value' => 'wrap',
				'default'      => '',
				'selectors'    => [
					'{{WRAPPER}} .topppa-nav-widget-container .topppa-main-nav-menu' => 'flex-wrap: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_nav_menu_align_content',
			[
				'label' => esc_html__('Align Content', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Start', 'topper-pack'),
						'icon' => 'eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('End', 'topper-pack'),
						'icon' => 'eicon-align-end-h',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-widget-container .topppa-main-nav-menu' => 'align-content: {{VALUE}};',
				],
				'condition' => [
					'topppa_nav_menu_enable_flex_wrap' => 'wrap',
				]
			]
		);

		$this->topppa_mega_menu_item_hover_effects();

		$this->add_control(
			'animation_line',
			[
				'label'     => __('Animation', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => 'Fade',
					'slide'    => 'Slide',
					'grow'     => 'Grow',
					'drop-in'  => 'Drop In',
					'drop-out' => 'Drop Out',
					'none'     => 'None',
				],
				'condition' => [
					'pointer' => ['underline', 'overline', 'double-line'],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label'     => __('Animation', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'    => 'Fade',
					'grow'    => 'Grow',
					'shrink'  => 'Shrink',
					'draw'    => 'Draw',
					'corners' => 'Corners',
					'none'    => 'None',
				],
				'condition' => [
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_background',
			[
				'label'     => __('Animation', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'                   => 'Fade',
					'grow'                   => 'Grow',
					'shrink'                 => 'Shrink',
					'sweep-left'             => 'Sweep Left',
					'sweep-right'            => 'Sweep Right',
					'sweep-up'               => 'Sweep Up',
					'sweep-down'             => 'Sweep Down',
					'shutter-in-vertical'    => 'Shutter In Vertical',
					'shutter-out-vertical'   => 'Shutter Out Vertical',
					'shutter-in-horizontal'  => 'Shutter In Horizontal',
					'shutter-out-horizontal' => 'Shutter Out Horizontal',
					'none'                   => 'None',
				],
				'condition' => [
					'pointer' => 'background',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label'     => __('Animation', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => 'Grow',
					'shrink' => 'Shrink',
					'sink'   => 'Sink',
					'float'  => 'Float',
					'skew'   => 'Skew',
					'rotate' => 'Rotate',
					'none'   => 'None',
				],
				'condition' => [
					'pointer' => 'text',
				],
			]
		);

		$this->get_vertical_toggle_settings();

		$this->add_control(
			'submenu_heading',
			[
				'label'     => __('Submenu Settings', 'topper-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'submenu_icon',
			[
				'label'                  => __('Submenu Indicator Icon', 'topper-pack'),
				'type'                   => Controls_Manager::ICONS,
				'default'                => [
					'value'   => 'fas fa-angle-down',
					'library' => 'fa-solid',
				],
				'recommended'            => [
					'fa-solid' => [
						'chevron-down',
						'angle-down',
						'caret-down',
						'plus',
					],
				],
				'label_block'            => false,
				'skin'                   => 'inline',
				'exclude_inline_options' => ['svg'],
				'frontend_available'     => true,
			]
		);

		$this->add_control(
			'submenu_item_icon',
			[
				'label'                  => __('Submenu Item Icon', 'topper-pack'),
				'type'                   => Controls_Manager::ICONS,
				'recommended'            => [
					'fa-solid' => [
						'chevron-down',
						'angle-down',
						'caret-down',
						'plus',
					],
				],
				'label_block'            => false,
				'skin'                   => 'inline',
				'exclude_inline_options' => ['svg'],
				'frontend_available'     => true,
			]
		);

		$default_pos   = is_rtl() ? 'left' : 'right';
		$default_align = is_rtl() ? 'flex-end' : 'flex-start';

		$this->add_responsive_control(
			'topppa_nav_ver_submenu',
			[
				'label'        => __('Submenu Position', 'topper-pack'),
				'type'         => Controls_Manager::CHOOSE,
				'render_type'  => 'template',
				'prefix_class' => 'topppa-vertical-',
				'options'      => [
					'left'  => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'      => $default_pos,
				'toggle'       => false,
				'condition'    => [
					'topppa_nav_menu_layout' => 'ver',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_sub_menu_align',
			[
				'label'     => __('Content Alignment', 'topper-pack'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-align-start-h',
					],
					'center'     => [
						'title' => __('Center', 'topper-pack'),
						'icon'  => 'eicon-justify-center-h',
					],
					'space-between'     => [
						'title' => __('Space Between', 'topper-pack'),
						'icon'  => 'eicon-justify-space-between-h',
					],
					'flex-end'   => [
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-align-end-h',
					],
				],
				'default'   => $default_align,
				'toggle'    => false,
				'selectors' => [
					'{{WRAPPER}} .topppa-sub-menu .topppa-sub-menu-link' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->topppa_submenu_event();

		$this->add_control(
			'submenu_trigger',
			[
				'label'       => __('Submenu Trigger', 'topper-pack'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'item',
				'render_type' => 'template',
				'options'     => [
					'icon' => __('Submenu Dropdwon Icon', 'topper-pack'),
					'item' => __('Submenu Item', 'topper-pack'),
				],
				'condition'   => [
					'topppa_nav_menu_layout' => ['hor', 'ver'],
					'submenu_event'      => 'click',
				],
			]
		);

		$this->topppa_submenu_animation();

		// sub-items badge hover
		$this->topppa_sub_items_badge_effects();

		$this->add_responsive_control(
			'dot_size',
			[
				'label'       => __('Dot Size', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units' => ['px'],
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .topppa-badge-dot .topppa-sub-item-badge' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'sub_badge_hv_effects' => 'dot',
				],
			]
		);

		// toggle menu settings
		$this->add_control(
			'topppa_toggle_heading',
			[
				'label'     => __('Mobile Menu Settings', 'topper-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'topppa_nav_menu_layout' => ['hor', 'ver'],
				],
			]
		);

		$this->add_control(
			'topppa_mobile_toggle_text',
			[
				'label' => __('Text', 'topper-pack'),
				'type' => Controls_Manager::TEXT,
				'default' => __('Menu', 'topper-pack'),
			]
		);

		$this->add_control(
			'topppa_mobile_toggle_icon',
			[
				'label' => __('Icon', 'topper-pack'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-bars',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'topppa_mobile_close_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-times',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'topppa_mobile_toggle_close',
			[
				'label' => esc_html__('Close Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Close', 'topper-pack'),
			]
		);

		$this->add_control(
			'topppa_mobile_menu_breakpoint',
			[
				'label'     => __('Breakpoint', 'topper-pack'),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'767'    => __('Mobile (<768)', 'topper-pack'),
					'1024'   => __('Tablet (<1025)', 'topper-pack'),
					'custom' => __('Custom', 'topper-pack'),
				],
				'default'   => '1024',
				'condition' => [
					'topppa_nav_menu_layout' => ['hor', 'ver'],
				],
			]
		);

		$this->add_control(
			'topppa_custom_breakpoint',
			[
				'label'       => __('Custom Breakpoint (px)', 'topper-pack'),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 0,
				'max'         => 2000,
				'step'        => 5,
				'description' => 'Use this option to control when to turn your menu into a toggle menu, Default is 1025',
				'condition'   => [
					'topppa_nav_menu_layout'        => ['hor', 'ver'],
					'topppa_mobile_menu_breakpoint' => 'custom',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get vertical toggle settings.
	 *
	 * @access private
	 * @since 4.9.15
	 */
	private function get_vertical_toggle_settings() {
		$this->add_control(
			'topppa_ver_toggle_switcher',
			[
				'label'        => __('Enable Collapsed Menu', 'topper-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'before',
				'render_type'  => 'template',
				'prefix_class' => 'topppa-ver-toggle-',
				'condition'    => [
					'topppa_nav_menu_layout' => 'ver',
				],
			]
		);

		$this->add_control(
			'topppa_ver_toggle_txt',
			[
				'label'     => __('Title', 'topper-pack'),
				'type'      => Controls_Manager::TEXT,
				'default'   => __('Premium Menu', 'topper-pack'),
				'condition' => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_ver_toggle_event',
			[
				'label'        => __('Open On', 'topper-pack'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'click',
				'render_type'  => 'template',
				'prefix_class' => 'topppa-ver-',
				'options'      => [
					'hover'  => __('Hover', 'topper-pack'),
					'click'  => __('Click', 'topper-pack'),
					'always' => __('Always', 'topper-pack'),
				],
				'condition'    => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_ver_toggle_open',
			[
				'label'       => __('Opened By Default', 'topper-pack'),
				'type'        => Controls_Manager::SWITCHER,
				'render_type' => 'template',
				'condition'   => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
					'topppa_ver_toggle_event'    => 'click',
				],
			]
		);

		$this->add_control(
			'topppa_ver_toggle_main_icon',
			[
				'label'       => __('Title Icon', 'topper-pack'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'skin'        => 'inline',
				'default'     => [
					'value'   => 'fas fa-bars',
					'library' => 'solid',
				],
				'condition'   => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_ver_toggle_toggle_icon',
			[
				'label'       => __('Toggle Icon', 'topper-pack'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'skin'        => 'inline',
				'default'     => [
					'value'   => 'fas fa-angle-down',
					'library' => 'solid',
				],
				'condition'   => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
				],
			]
		);

		$this->add_control(
			'topppa_ver_toggle_close_icon',
			[
				'label'       => __('Close Icon', 'topper-pack'),
				'type'        => Controls_Manager::ICONS,
				'label_block' => false,
				'skin'        => 'inline',
				'default'     => [
					'value'   => 'fas fa-angle-up',
					'library' => 'solid',
				],
				'condition'   => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
					'topppa_ver_toggle_event!'   => 'always',
				],
			]
		);

		$this->add_control(
			'topppa_ver_spacing',
			[
				'label'       => __('Title Spacing', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => ['px', 'em'],
				'description' => __('Use this option to control the spacing between the title icon and the title.', 'topper-pack'),
				'selectors'   => [
					'{{WRAPPER}} .topppa-ver-toggler-txt' => 'text-indent: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'topppa_nav_menu_layout'     => 'ver',
					'topppa_ver_toggle_switcher' => 'yes',
				],
			]
		);
	}

	/**
	 * Get vertical toggler style.
	 *
	 * @access private
	 * @since 4.9.15
	 */
	private function get_ver_toggler_style() {
		$this->start_controls_section(
			'topppa_ver_toggler_style_section',
			[
				'label'     => __('Collapsed Menu Style', 'topper-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_ver_toggle_switcher' => 'yes',
					'topppa_nav_menu_layout'     => 'ver',
				],
			]
		);

		$this->add_control(
			'topppa_ver_title_heading',
			[
				'label' => __('Title', 'topper-pack'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_ver_title_typo',
				'selector' => '{{WRAPPER}} .topppa-ver-toggler-txt',
			]
		);

		$this->add_control(
			'topppa_ver_title_icon_size',
			[
				'label'      => __('Icon Size', 'topper-pack'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-ver-title-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-ver-title-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'topppa_ver_toggle_main_icon[value]!' => '',
				],
			]
		);

		$this->start_controls_tabs('topppa_ver_title_tabs');

		$this->start_controls_tab(
			'topppa_ver_title_tab_normal',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);

		$this->add_control(
			'topppa_ver_title_color',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-ver-toggler-txt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'topppa_ver_title_icon_color',
			[
				'label'     => __('Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-ver-title-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-ver-title-icon svg, {{WRAPPER}} .topppa-ver-title-icon svg path' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'topppa_ver_toggle_main_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_ver_title_tab_hov',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);

		$this->add_control(
			'topppa_ver_title_color_hov',
			[
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-toggler-txt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'topppa_ver_title_icon_color_hov',
			[
				'label'     => __('Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-title-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-title-icon svg, {{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-title-icon svg path' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'topppa_ver_toggle_main_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'topppa_ver_toggle_heading',
			array(
				'label'      => __('Toggle Icon', 'topper-pack'),
				'type'       => Controls_Manager::HEADING,
				'separator'  => 'before',
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'topppa_ver_toggle_toggle_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'topppa_ver_toggle_close_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'topppa_ver_toggle_icon_size',
			array(
				'label'      => __('Size', 'topper-pack'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-ver-toggler-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-ver-toggler-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'topppa_ver_toggle_toggle_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'topppa_ver_toggle_close_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->start_controls_tabs('topppa_ver_toggle_icon_tabs');

		$this->start_controls_tab(
			'topppa_ver_toggle_tab_normal',
			array(
				'label'      => __('Normal', 'topper-pack'),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'topppa_ver_toggle_toggle_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'topppa_ver_toggle_close_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'topppa_ver_toggle_icon_color',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-ver-toggler-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-ver-toggler-btn svg, {{WRAPPER}} .topppa-ver-toggler-btn svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_ver_toggle_tab_hov',
			array(
				'label'      => __('Hover', 'topper-pack'),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'topppa_ver_toggle_toggle_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
						array(
							'name'     => 'topppa_ver_toggle_close_icon[value]',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->add_control(
			'topppa_ver_toggle_icon_color_hov',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-toggler-btn i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-toggler-btn svg,
					 {{WRAPPER}} .topppa-ver-toggler:hover .topppa-ver-toggler-btn svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'topppa_ver_container_heading',
			array(
				'label'     => __('Container', 'topper-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->start_controls_tabs('topppa_ver_toggler_tabs');

		$this->start_controls_tab(
			'topppa_ver_toggler_tab_normal',
			array(
				'label' => __('Normal', 'topper-pack'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_ver_toggler_bg',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-ver-toggler',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'topppa_ver_toggler_shadow',
				'selector' => '{{WRAPPER}} .topppa-ver-toggler',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_ver_toggler_tab_hov',
			array(
				'label' => __('Hover', 'topper-pack'),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_ver_toggler_bg_hov',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-ver-toggler:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'topppa_ver_toggler_shadow_hov',
				'selector' => '{{WRAPPER}} .topppa-ver-toggler:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'topppa_ver_toggler_border',
				'selector'  => '{{WRAPPER}} .topppa-ver-toggler',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'topppa_ver_toggler_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-ver-toggler' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_ver_toggler_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-ver-toggler' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Get menu container style.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_menu_container_style() {

		$this->start_controls_section(
			'topppa_nav_style_section',
			array(
				'label'     => __('Desktop Menu Style', 'topper-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'topppa_nav_menu_layout' => array('hor', 'ver'),
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_menu_height',
			array(
				'label'       => __('Height', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array('px', 'em', '%', 'custom'),
				'label_block' => true,
				'selectors'   => array(
					'{{WRAPPER}}.topppa-nav-hor > .elementor-widget-container > .topppa-nav-widget-container > .topppa-ver-inner-container > .topppa-nav-menu-container' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'topppa_nav_menu_layout' => 'hor',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_menu_width',
			array(
				'label'       => __('Width', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array('px', '%', 'custom'),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'label_block' => true,
				'selectors'   => array(
					'{{WRAPPER}}.topppa-nav-ver .topppa-ver-inner-container' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'   => array(
					'topppa_nav_menu_layout' => 'ver',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'topppa_nav_menu_shadow',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_nav_menu_background',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_nav_menu_border',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container',
			)
		);

		$this->add_control(
			'topppa_nav_menu_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_menu_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Get toggle menu container style.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_toggle_menu_sytle() {

		// <==========>
		// <==========>MOBILE MENU BOX STYLES <==========>

		$this->start_controls_section(
			'mobile_menu_box_styles',
			[
				'label' => esc_html__('Mobile Menu Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'mobile_menu_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '#topppa-mobile-menu-detached-{{ID}}',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'mobile_menu_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '#topppa-mobile-menu-detached-{{ID}}',
			]
		);
		$this->add_responsive_control(
			'mobile_menu_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'mobile_menu_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '#topppa-mobile-menu-detached-{{ID}}',
			]
		);
		$this->add_responsive_control(
			'mobile_menu_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_menu_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'topppa_toggle_mene_style_section',
			array(
				'label' => __('Expand Menu Style', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'topppa_ham_toggle_style',
			array(
				'label' => __('Toggle Button', 'topper-pack'),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->start_controls_tabs('topppa_ham_toggle_style_tabs');

		$this->start_controls_tab(
			'topppa_ham_toggle_icon_tab',
			array(
				'label' => __('Icon', 'topper-pack'),
			)
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_icon_size',
			array(
				'label'       => __('Size', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array('px', 'em', '%'),
				'label_block' => true,
				'selectors'   => array(
					'{{WRAPPER}} .topppa-hamburger-toggle i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-hamburger-toggle svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'topppa_ham_toggle_color',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-hamburger-toggle i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-hamburger-toggle svg, {{WRAPPER}} .topppa-hamburger-toggle svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'topppa_ham_toggle_color_hover',
			array(
				'label'     => __('Hover Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-hamburger-toggle:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .topppa-hamburger-toggle:hover svg, {{WRAPPER}} .topppa-hamburger-toggle:hover svg path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_ham_toggle_label_tab',
			array(
				'label' => __('Text', 'topper-pack'),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'topppa_ham_toggle_txt_typo',
				'selector' => '{{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-text, {{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-close',
			)
		);

		$this->add_control(
			'topppa_ham_toggle_txt_color',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-text, {{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-close' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'topppa_ham_toggle_txt_color_hover',
			array(
				'label'     => __('Hover Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-hamburger-toggle:hover .topppa-toggle-text, {{WRAPPER}} .topppa-hamburger-toggle:hover .topppa-toggle-close' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_txt_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-text, {{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_txt_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-text, {{WRAPPER}} .topppa-hamburger-toggle .topppa-toggle-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'topppa_ham_toggle_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-widget-container .topppa-hamburger-toggle .topppa-toggle-text' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-hamburger-toggle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-hamburger-toggle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_ham_toggle_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-hamburger-toggle',
			]
		);

		$this->add_control(
			'topppa_ham_toggle_bg_hover',
			array(
				'label'     => __('Hover Background Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-hamburger-toggle:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'topppa_ham_toggle_shadow',
				'selector' => '{{WRAPPER}} .topppa-hamburger-toggle',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_ham_toggle_border',
				'selector' => '{{WRAPPER}} .topppa-hamburger-toggle',
			)
		);

		$this->add_control(
			'topppa_ham_toggle_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-hamburger-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-hamburger-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_ham_toggle_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-hamburger-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'topppa_ham_menu_style',
			[
				'label' => esc_html__('Toggle Menu', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_ham_menu_item_color',
			[
				'label' => esc_html__('Item Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_ham_menu_active_item_color',
			[
				'label' => esc_html__('Active Item Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item.topppa-active-item .topppa-mega-menu-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_ham_menu_item_bg_color',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link',
			]
		);

		$this->add_responsive_control(
			'topppa_ham_menu_dd_icon_color',
			[
				'label' => esc_html__('Dropdown Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-dropdown-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_ham_menu_dd_icon_size',
			[
				'label' => esc_html__('Dropdown Icon Size', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-dropdown-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'topppa_ham_menu_shadow',
				'selector' => '#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'topppa_ham_menu_border',
				'selector' => '#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link',
			]
		);

		$this->add_responsive_control(
			'topppa_ham_menu_rad',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_ham_menu_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_ham_menu_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'#topppa-mobile-menu-detached-{{ID}} .topppa-main-mobile-menu .topppa-nav-menu-item .topppa-mega-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get Menu Item Extras.
	 * Adds Menu Items' Icon & Badge Style.
	 *
	 * @access private
	 * @since  4.9.4
	 */
	private function get_menu_item_extras() {

		$this->start_controls_section(
			'topppa_nav_item_extra_style',
			array(
				'label' => __('Menu Item Icon & Badge', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs('topppa_nav_items_extras');

		$this->start_controls_tab(
			'topppa_nav_item_icon_style',
			array(
				'label' => __('Icon', 'topper-pack'),
			)
		);

		$left_order  = is_rtl() ? '1' : '0';
		$right_order = is_rtl() ? '0' : '1';
		$default     = is_rtl() ? $right_order : $left_order;

		$this->add_responsive_control(
			'topppa_nav_item_icon_pos',
			array(
				'label'     => __('Position', 'topper-pack'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					$left_order  => array(
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-h-align-left',
					),
					$right_order => array(
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => $default,
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon' => 'order: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_icon_size',
			array(
				'label'       => __('Size', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => array('px'),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon.dashicons, {{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > img.topppa-item-icon, {{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon.topppa-lottie-animation' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'menu_item_icon_back_color',
			array(
				'label'     => __('Background Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'menu_item_icon_radius',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_icon_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_icon_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_nav_item_badge_style',
			array(
				'label' => __('Badge', 'topper-pack'),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'topppa_nav_item_badge_typo',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-badge,
				{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-rn-badge,
				{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-rn-badge',
			)
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_nav_item_badge_border',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-badge,
				{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-rn-badge,
				{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-rn-badge',
			)
		);

		$this->add_control(
			'topppa_nav_item_badge_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-badge,
					{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-rn-badge,
					{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-rn-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_badge_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-badge,
					{{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-rn-badge,
					 {{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-rn-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_badge_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-item-badge,
					 {{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-rn-badge,
					 {{WRAPPER}} .topppa-ver-inner-container > div .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link > .topppa-rn-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Get menu item style.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_menu_item_style() {

		$this->start_controls_section(
			'topppa_nav_item_style_section',
			array(
				'label' => __('Menu Item Style', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'menu_gap',
			[
				'label' => esc_html__('Gap', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-widget-container .topppa-main-nav-menu' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'topppa_nav_item_typo',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link',
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_drop_icon_size',
			array(
				'label'      => __('Dropdown Icon Size', 'topper-pack'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link .topppa-dropdown-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_pointer_thinkness',
			array(
				'label'      => __('Pointer Thickness', 'topper-pack'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px'),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-pointer-underline .topppa-mega-menu-link-parent::after,
					{{WRAPPER}} .topppa-nav-pointer-overline .topppa-mega-menu-link-parent::before,
					{{WRAPPER}} .topppa-nav-pointer-double-line .topppa-mega-menu-link-parent::before,
					{{WRAPPER}} .topppa-nav-pointer-double-line .topppa-mega-menu-link-parent::after' => 'height: {{SIZE}}px;',
					'{{WRAPPER}} .topppa-nav-pointer-framed:not(.topppa-nav-animation-draw):not(.topppa-nav-animation-corners) .topppa-mega-menu-link-parent::before' => 'border-width: {{SIZE}}px;',
					'{{WRAPPER}} .topppa-nav-pointer-framed.topppa-nav-animation-draw .topppa-mega-menu-link-parent::before' => 'border-width: 0 0 {{SIZE}}px {{SIZE}}px;',
					'{{WRAPPER}} .topppa-nav-pointer-framed.topppa-nav-animation-draw .topppa-mega-menu-link-parent::after' => 'border-width: {{SIZE}}px {{SIZE}}px 0 0;',
					'{{WRAPPER}} .topppa-nav-pointer-framed.topppa-nav-animation-corners .topppa-mega-menu-link-parent::before' => 'border-width: {{SIZE}}px 0 0 {{SIZE}}px',
					'{{WRAPPER}} .topppa-nav-pointer-framed.topppa-nav-animation-corners .topppa-mega-menu-link-parent::after' => 'border-width: 0 {{SIZE}}px {{SIZE}}px 0',
				),
				'condition'  => array(
					'pointer!' => array('none', 'text', 'background'),
				),

			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_drop_icon_margin',
			array(
				'label'      => __('Dropdown Icon Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link .topppa-dropdown-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs('topppa_nav_items_styles');

		$this->start_controls_tab(
			'topppa_nav_item_normal',
			array(
				'label' => __('Normal', 'topper-pack'),
			)
		);

		$this->add_control(
			'topppa_nav_item_color',
			[
				'label'     => __('Navigation Item Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A1A1A',
				'selectors' => [
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_nav_item_drop_icon_color',
			array(
				'label'     => __('Dropdown Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A1A1A',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link .topppa-dropdown-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_nav_item_bg',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'topppa_nav_item_shadow',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_nav_item_border',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link',
			)
		);

		$this->add_control(
			'topppa_nav_item_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item > .topppa-mega-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_nav_item_hover',
			array(
				'label' => __('Hover', 'topper-pack'),
			)
		);

		$this->add_control(
			'topppa_nav_item_color_hover',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0E59F2',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_drop_icon_hover',
			array(
				'label'     => __('Dropdown Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0E59F2',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link .topppa-dropdown-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_nav_item_bg_hover',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link',
			)
		);

		$this->add_control(
			'menu_item_pointer_color_hover',
			array(
				'label'     => __('Item Hover Effect Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A1A1A',
				'selectors' => array(
					'{{WRAPPER}} .topppa-nav-widget-container:not(.topppa-nav-pointer-framed) .topppa-mega-menu-link-parent:before,
					{{WRAPPER}} .topppa-nav-widget-container:not(.topppa-nav-pointer-framed) .topppa-mega-menu-link-parent:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .topppa-nav-pointer-framed .topppa-mega-menu-link-parent:before,
					{{WRAPPER}} .topppa-nav-pointer-framed .topppa-mega-menu-link-parent:after' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'pointer!' => array('none', 'text'),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'topppa_nav_item_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_nav_item_border_hover',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link',
			)
		);

		$this->add_control(
			'topppa_nav_item_rad_hover',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_padding_hover',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover > .topppa-mega-menu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_margin_hover',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-nav-menu-item:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_nav_item_active',
			array(
				'label' => __('Active', 'topper-pack'),
			)
		);

		$this->add_control(
			'topppa_nav_item_color_active',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0E59F2',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item > .topppa-mega-menu-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_drop_icon_active',
			array(
				'label'     => __('Dropdown Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0E59F2',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item > .topppa-mega-menu-link .topppa-dropdown-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_nav_item_bg_active',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item > .topppa-mega-menu-link',
			)
		);

		$this->add_control(
			'menu_item_pointer_color_active',
			array(
				'label'     => __('Item Hover Effect Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-nav-widget-container:not(.topppa-nav-pointer-framed) .topppa-active-item .topppa-mega-menu-link-parent:before,
					{{WRAPPER}} .topppa-nav-widget-container:not(.topppa-nav-pointer-framed) .topppa-active-item .topppa-mega-menu-link-parent:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .topppa-nav-pointer-framed .topppa-active-item .topppa-mega-menu-link-parent:before,
					{{WRAPPER}} .topppa-nav-pointer-framed .topppa-active-item .topppa-mega-menu-link-parent:after' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'pointer!' => array('none', 'text'),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'topppa_nav_item_shadow_active',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_nav_item_border_active',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item',
			)
		);

		$this->add_control(
			'topppa_nav_item_rad_active',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_padding_active',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_nav_item_margin_active',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu > .topppa-active-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Get submenu container style.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_submenu_container_style() {

		$this->start_controls_section(
			'topppa_submenu_style_section',
			array(
				'label' => __('Submenu Style', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs('topppa_sub_menus_style');

		$this->start_controls_tab(
			'topppa_sub_simple',
			array(
				'label' => __('Simple Panel', 'topper-pack'),
			)
		);
		$this->add_responsive_control(
			'topppa_sub_minwidth',
			array(
				'label'       => __('Minimum Width', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => array('px', 'em', '%', 'custom'),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu,
                    {{WRAPPER}}.topppa-nav-ver .topppa-nav-menu-item.menu-item-has-children .topppa-sub-menu,
                    {{WRAPPER}}.topppa-nav-hor .topppa-nav-menu-item.menu-item-has-children .topppa-sub-menu' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'submenu_position_x',
			[
				'label' => __('Position X (Left)', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => ['min' => -1000, 'max' => 1000],
					'%'  => ['min' => -100, 'max' => 100],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-hor:not(.topppa-hamburger-menu) .topppa-nav-menu-item .topppa-sub-menu' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_translate_x',
			[
				'label' => __('Translate X', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => ['min' => -200, 'max' => 200],
				],
				'default' => ['size' => -50, 'unit' => '%'], // default same as your CSS
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-hor:not(.topppa-hamburger-menu) .topppa-nav-menu-item .topppa-sub-menu' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);


		$this->add_responsive_control(
			'topppa_simple_position_y',
			array(
				'label'       => __('Position Y (Top)', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => array('px', '%', 'em', 'rem'),
				'range'       => array(
					'px' => array(
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					),
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'topppa_sub_shadow',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_sub_bg',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_sub_border',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu',
			)
		);

		$this->add_control(
			'topppa_sub_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-sub-menu, {{WRAPPER}} .topppa-mobile-menu-container .topppa-sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_sub_mega',
			array(
				'label' => __('Mega Panel', 'topper-pack'),
			)
		);

		$mega_pos = is_rtl() ? 'right' : 'left';

		$this->add_responsive_control(
			'topppa_sub_mega_offset',
			array(
				'label'       => __('Offset', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => array('px', '%'),
				'range'       => array(
					'px' => array(
						'min' => -1000,
						'max' => 2000,
					),
					'%'  => array(
						'min' => -100,
						'max' => 100,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}}.topppa-nav-hor .topppa-nav-menu-container .topppa-mega-content-container' => $mega_pos . ': {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.topppa-nav-ver .topppa-nav-menu-container .topppa-mega-content-container' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'topppa_sub_mega_shadow',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container .topppa-mega-content-container, {{WRAPPER}} .topppa-mobile-menu-container .topppa-mega-content-container',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_sub_mega_bg',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container .topppa-mega-content-container, {{WRAPPER}} .topppa-mobile-menu-container .topppa-mega-content-container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_sub_mega_border',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-container .topppa-mega-content-container, {{WRAPPER}} .topppa-mobile-menu-container .topppa-mega-content-container',
			)
		);

		$this->add_control(
			'topppa_sub_mega_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-mega-content-container, {{WRAPPER}} .topppa-mobile-menu-container .topppa-mega-content-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_mega_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-mega-content-container, {{WRAPPER}} .topppa-mobile-menu-container .topppa-mega-content-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_mega_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-nav-menu-container .topppa-mega-content-container, {{WRAPPER}} .topppa-mobile-menu-container .topppa-mega-content-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Get submenu item style.
	 *
	 * @access private
	 * @since 4.9.3
	 */
	private function get_submenu_item_style() {

		$this->start_controls_section(
			'topppa_submenu_item_style_section',
			array(
				'label' => __('Submenu Item Style', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'topppa_sub_item_typo',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-link',
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_drop_icon_size',
			array(
				'label'      => __('Dropdown Icon Size', 'topper-pack'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-link .topppa-dropdown-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_drop_icon_margin',
			array(
				'label'      => __('Dropdown Icon Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-link .topppa-dropdown-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs('topppa_sub_items_styles');

		$this->start_controls_tab(
			'topppa_sub_item_normal',
			array(
				'label' => __('Normal', 'topper-pack'),
			)
		);

		$this->add_control(
			'topppa_sub_item_color',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A1A1A',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_drop_icon_color',
			array(
				'label'     => __('Dropdown Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1A1A1A',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-link .topppa-dropdown-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_sub_item_bg',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'topppa_sub_item_shadow',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_sub_item_border',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item',
			)
		);

		$this->add_control(
			'topppa_sub_item_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_sub_item_hover',
			array(
				'label' => __('Hover', 'topper-pack'),
			)
		);

		$this->add_control(
			'topppa_sub_item_color_hover',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu-item:hover > .topppa-sub-menu-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_drop_icon_hover',
			array(
				'label'     => __('Dropdown Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu-item:hover > .topppa-sub-menu-link .topppa-dropdown-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'topppa_sub_item_bg_hover',
				'types'          => array('classic', 'gradient'),
				'selector'       => '{{WRAPPER}}:not(.topppa-hamburger-menu):not(.topppa-nav-slide):not(.topppa-nav-dropdown) .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item:hover,
									{{WRAPPER}}.topppa-hamburger-menu .topppa-main-nav-menu .topppa-sub-menu > .topppa-sub-menu-item:hover > .topppa-sub-menu-link,
									{{WRAPPER}}.topppa-nav-slide .topppa-main-nav-menu .topppa-sub-menu > .topppa-sub-menu-item:hover > .topppa-sub-menu-link,
									{{WRAPPER}}.topppa-nav-dropdown .topppa-main-nav-menu .topppa-sub-menu > .topppa-sub-menu-item:hover > .topppa-sub-menu-link',
				'fields_options' => array(
					'background' => array(
						'default' => 'classic',
					),
					'color'      => array(
						'default'   => '#1A1A1A',
					),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'topppa_sub_item_shadow_hover',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_sub_item_border_hover',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item:hover',
			)
		);

		$this->add_control(
			'topppa_sub_item_rad_hover',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_padding_hover',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_margin_hover',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-sub-menu-item:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_sub_item_active',
			array(
				'label' => __('Active', 'topper-pack'),
			)
		);

		$this->add_control(
			'topppa_sub_item_color_active',
			array(
				'label'     => __('Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item .topppa-sub-menu-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_drop_icon_active',
			array(
				'label'     => __('Dropdown Icon Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0E59F2',
				'selectors' => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item .topppa-sub-menu-link .topppa-dropdown-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'topppa_sub_item_bg_active',
				'types'    => array('classic', 'gradient'),
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'topppa_sub_item_shadow_active',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_sub_item_border_active',
				'selector' => '{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item',
			)
		);

		$this->add_control(
			'topppa_sub_item_rad_active',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_padding_active',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_item_margin_active',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-main-nav-menu .topppa-sub-menu .topppa-active-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Get Submenu Item Extras.
	 * Adds Submenu Items' Icon & Badge Style.
	 *
	 * @access private
	 * @since  4.9.4
	 */
	private function get_sub_menu_item_extras() {

		$this->start_controls_section(
			'topppa_sub_extra_style',
			array(
				'label' => __('Submenu Item Icon & Badge', 'topper-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs('topppa_sub_items_extras');

		$this->start_controls_tab(
			'topppa_sub_icon_style',
			array(
				'label' => __('Icon', 'topper-pack'),
			)
		);

		$left_order  = is_rtl() ? '1' : '0';
		$right_order = is_rtl() ? '0' : '1';
		$default     = is_rtl() ? $right_order : $left_order;

		$this->add_responsive_control(
			'topppa_sub_icon_pos',
			array(
				'label'     => __('Position', 'topper-pack'),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					$left_order  => array(
						'title' => __('Left', 'topper-pack'),
						'icon'  => 'eicon-h-align-left',
					),
					$right_order => array(
						'title' => __('Right', 'topper-pack'),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'   => $default,
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon' => 'order: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_icon_size',
			array(
				'label'       => __('Size', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => array('px'),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 300,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon.dashicons, {{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link img.topppa-sub-item-icon, {{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon.topppa-lottie-animation' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'sub_item_icon_back_color',
			array(
				'label'     => __('Background Color', 'topper-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'sub_item_icon_radius',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_icon_margin',
			array(
				'label'      => __('Margin', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_icon_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_sub_badge_style',
			array(
				'label' => __('Badge', 'topper-pack'),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'topppa_sub_badge_typo',
				'selector' => '{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}} .topppa-sub-menu-item .topppa-rn-badge, {{WRAPPER}} .topppa-mega-content-container .topppa-rn-badge',
			)
		);

		// TODO: check the all the badges CSS.
		$badge_pos = is_rtl() ? 'left' : 'right';

		$this->add_responsive_control(
			'topppa_sub_badge_hor',
			array(
				'label'       => __('Horizontal Offset', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => array('px', '%'),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}}:not(.topppa-nav-ver) .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}}:not(.topppa-nav-ver) .topppa-sub-menu-item .topppa-rn-badge, {{WRAPPER}} .topppa-mega-content-container .topppa-rn-badge' => $badge_pos . ' : {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.topppa-nav-ver.topppa-vertical-right .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}}.topppa-nav-ver.topppa-vertical-right .topppa-sub-menu-item .topppa-rn-badge' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.topppa-nav-ver.topppa-vertical-left .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}}.topppa-nav-ver.topppa-vertical-left .topppa-sub-menu-item .topppa-rn-badge' => 'left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_badge_ver',
			array(
				'label'       => __('Vertical Offset', 'topper-pack'),
				'type'        => Controls_Manager::SLIDER,
				'label_block' => true,
				'size_units'  => array('px', '%'),
				'range'       => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}} .topppa-sub-menu-item .topppa-rn-badge, {{WRAPPER}} .topppa-mega-content-container .topppa-rn-badge' => 'top: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'topppa_sub_badge_border',
				'selector' => '{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}} .topppa-sub-menu-item .topppa-rn-badge, {{WRAPPER}} .topppa-mega-content-container .topppa-rn-badge',
			)
		);

		$this->add_control(
			'topppa_sub_badge_rad',
			array(
				'label'      => __('Border Radius', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge, {{WRAPPER}} .topppa-sub-menu-item .topppa-rn-badge, {{WRAPPER}} .topppa-mega-content-container .topppa-rn-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'topppa_sub_badge_padding',
			array(
				'label'      => __('Padding', 'topper-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .topppa-sub-menu-item .topppa-sub-menu-link .topppa-sub-item-badge,
					 {{WRAPPER}} .topppa-sub-menu-item .topppa-rn-badge,
					 {{WRAPPER}} .topppa-mega-content-container .topppa-rn-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render Nav Menu widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$menu_id = $settings['topppa_nav_menus'];

		// Fallback: if no menu selected or selected menu invalid, try to auto-detect a usable menu
		if (! $menu_id || ! $this->is_valid_menu($menu_id)) {
			$fallback = 0;
			// Check theme locations first (include custom 'mainmenu')
			$locations = get_nav_menu_locations();
			if (is_array($locations)) {
				foreach (array('primary', 'menu-1', 'header', 'main', 'mainmenu', 'top') as $loc) {
					if (!empty($locations[$loc])) {
						$maybe = (int) $locations[$loc];
						if ($this->is_valid_menu($maybe)) {
							$fallback = $maybe;
							break;
						}
					}
				}
			}
			// Otherwise choose the largest menu by item count
			if (! $fallback) {
				$menus = wp_get_nav_menus();
				$best_id = 0;
				$best_count = -1;
				foreach ($menus as $menu) {
					$obj = wp_get_nav_menu_object($menu->term_id);
					$count = ($obj && isset($obj->count)) ? (int) $obj->count : 0;
					if ($count > $best_count) {
						$best_count = $count;
						$best_id = (int) $menu->term_id;
					}
				}
				if ($best_count > 0) {
					$fallback = $best_id;
				}
			}
			if ($fallback) {
				$menu_id = $fallback;
			}
		}

		if (! $menu_id) {
?>
			<div class="topppa-error-notice">
				<?php echo esc_html(__('Please select a menu from Mega Menu widget settings.', 'topper-pack')); ?>
			</div>
		<?php
			return;
		}

		if (! $this->is_valid_menu($menu_id)) {
		?>
			<div class="topppa-error-notice">
				<?php echo esc_html(__('This is an empty menu. Please make sure your menu has items.', 'topper-pack')); ?>
			</div>
		<?php
			return;
		}

		$break_point = 'custom' === $settings['topppa_mobile_menu_breakpoint'] ? $settings['topppa_custom_breakpoint'] : $settings['topppa_mobile_menu_breakpoint'];

		// Ensure we have a valid breakpoint value
		if (empty($break_point) || !is_numeric($break_point)) {
			$break_point = 1025; // Default fallback
		} else {
			$break_point = (int) $break_point;
		}

		$is_click = 'click' === $settings['topppa_ver_toggle_event'] && 'yes' !== $settings['topppa_ver_toggle_open'];

		$is_hover = 'hover' === $settings['topppa_ver_toggle_event'];

		$menu_list = $this->get_menu_list();

		if (! $menu_list) {
			return;
		}

		$div_end = '';

		$menu_settings = array(
			'breakpoint'      => $break_point,
			'mobileLayout'    => 'dropdown',
			'mainLayout'      => $settings['topppa_nav_menu_layout'],
			'hoverEffect'     => $settings['sub_badge_hv_effects'],
			'submenuEvent'    => $settings['submenu_event'],
			'submenuTrigger'  => $settings['submenu_trigger'],
		);

		$is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();

		$this->add_render_attribute(
			'wrapper',
			array(
				'data-settings' => wp_json_encode($menu_settings),
				'class'         => array(
					'topppa-nav-widget-container',
					'topppa-nav-pointer-' . $settings['pointer'],
				),
			)
		);

		if ('yes' === $settings['load_hidden']) {
			$hidden_style = $is_edit_mode ? '' : 'visibility:hidden; opacity:0;';

			$this->add_render_attribute('wrapper', 'style', $hidden_style);
		}

		if ('yes' === $settings['topppa_ver_toggle_switcher'] && ($is_click || $is_hover)) {
			$this->add_render_attribute('wrapper', 'class', 'topppa-ver-collapsed');
		}


		switch ($settings['pointer']) {
			case 'underline':
			case 'overline':
			case 'double-line':
				$this->add_render_attribute('wrapper', 'class', 'topppa-nav-animation-' . $settings['animation_line']);
				break;
			case 'framed':
				$this->add_render_attribute('wrapper', 'class', 'topppa-nav-animation-' . $settings['animation_framed']);
				break;
			case 'text':
				$this->add_render_attribute('wrapper', 'class', 'topppa-nav-animation-' . $settings['animation_text']);
				break;
			case 'background':
				$this->add_render_attribute('wrapper', 'class', 'topppa-nav-animation-' . $settings['animation_background']);
				break;
		}

		/**
		 * Hamburger Menu Button.
		 */
		?>

		<div <?php echo wp_kses_post($this->get_render_attribute_string('wrapper')); ?>>
			<div class="topppa-ver-inner-container">
				<div class="topppa-hamburger-toggle topppa-mobile-menu-icon" role="button" aria-label="Toggle Menu">
					<span class="topppa-toggle-text">
						<?php
						Icons_Manager::render_icon($settings['topppa_mobile_toggle_icon'], array('aria-hidden' => 'true'));
						?>
						<span><?php echo esc_html($settings['topppa_mobile_toggle_text']); ?></span>
					</span>
					<span class="topppa-toggle-close">
						<?php
						Icons_Manager::render_icon($settings['topppa_mobile_close_icon'], array('aria-hidden' => 'true'));
						echo esc_html($settings['topppa_mobile_toggle_close']);
						?>
					</span>
				</div>
				<?php

				if ('yes' === $settings['topppa_ver_toggle_switcher']) {
					$this->add_vertical_toggler();
				}

				$args = array(
					'container'   => '',
					'menu'        => $menu_id,
					'menu_class'  => 'topppa-nav-menu topppa-main-nav-menu',
					'echo'        => false,
					'fallback_cb' => 'wp_page_menu',
					'walker'      => new TOPPPA_Nav_Menu_Walker($settings),
				);

				$menu_html = wp_nav_menu($args);

				if (in_array($settings['topppa_nav_menu_layout'], array('hor', 'ver'), true)) {
				?>
					<div class="topppa-nav-menu-container topppa-nav-default">
						<?php echo $menu_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
						?>
					</div>
				<?php
				}

				?>
				<div class="topppa-mobile-menu-container">
					<div class="topppa-menu-area">
						<?php echo $this->mobile_menu_filter($menu_html, $menu_id);  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
						?>
					</div>
				</div>
				<?php

				echo wp_kses_post($div_end);
				?>
			</div>
		</div>

		<!-- Detached Mobile Menu Template -->
		<script type="text/html" id="topppa-mobile-menu-template-<?php echo esc_attr($this->get_id()); ?>">
			<div id="topppa-mobile-menu-detached-<?php echo esc_attr($this->get_id()); ?>" class="topppa-mobile-menu-detached" data-widget-id="<?php echo esc_attr($this->get_id()); ?>">
				<div class="topppa-menu-area">
					<?php echo $this->mobile_menu_filter($menu_html, $menu_id);  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
					?>
				</div>
			</div>
		</script>
	<?php
	}

	private function add_vertical_toggler() {

		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();

	?>
		<div class="topppa-ver-toggler topppa-ver-toggler-<?php echo esc_attr($id); ?>">
			<div class="topppa-ver-toggler-title">
				<span class="topppa-ver-title-icon">
					<?php Icons_Manager::render_icon($settings['topppa_ver_toggle_main_icon'], array('aria-hidden' => 'true')); ?>
				</span>
				<span class="topppa-ver-toggler-txt">
					<?php echo esc_html($settings['topppa_ver_toggle_txt']); ?>
				</span>
			</div>
			<div class="topppa-ver-toggler-btn">
				<span class="topppa-ver-open">
					<?php Icons_Manager::render_icon($settings['topppa_ver_toggle_toggle_icon'], array('aria-hidden' => 'true')); ?>
				</span>
				<?php if ('always' !== $settings['topppa_ver_toggle_event']) : ?>
					<span class="topppa-ver-close">
						<?php Icons_Manager::render_icon($settings['topppa_ver_toggle_close_icon'], array('aria-hidden' => 'true')); ?>
					</span>
				<?php endif; ?>
			</div>
		</div>
<?php
	}

	/**
	 * Is Valid Menu.
	 *
	 * @access private
	 * @since 4.9.10
	 *
	 * @param string|int $id  menu id.
	 *
	 * @return bool   true if the menu has items.
	 */
	private function is_valid_menu($id) {

		$is_valid = false;

		$menu_object = wp_get_nav_menu_object($id);

		if ($menu_object && isset($menu_object->count)) {
			$item_count = $menu_object->count;

			if (0 < $item_count) {
				$is_valid = true;
			}
		}

		return $is_valid;
	}

	/**
	 * Filters mobile menus.
	 * Changes the menu id to prevent duplicated ids in the DOM.
	 *
	 * @access private.
	 *
	 * @param string     $menu_html desktop menu html.
	 * @param stirng|int $menu_id menu id.
	 *
	 * @return string
	 */
	private function mobile_menu_filter($menu_html, $menu_id) {

		// Increment the mobile menu id & change its classes to mobile menu classes.
		$menu_object = wp_get_nav_menu_object($menu_id);
		$slug = 'menu-default'; // Default fallback

		if ($menu_object && isset($menu_object->slug)) {
			$slug = 'menu-' . $menu_object->slug;
		}

		$search  = array('id="' . $slug . '"', 'class="topppa-nav-menu topppa-main-nav-menu"');
		$replace = array('id="' . $slug . '-1"', 'class="topppa-mobile-menu topppa-main-mobile-menu topppa-main-nav-menu"');

		$menu_html = $this->fix_duplicated_ids($menu_html, 'topppa-nav-menu-item-'); // fixes's the items duplicated ids.
		$menu_html = $this->fix_duplicated_ids($menu_html, 'topppa-mega-content-'); // fixes's the items duplicated ids.
		return str_replace($search, $replace, $menu_html);
	}

	/**
	 * Filters mobile menus.
	 * Changes the menu id to prevent duplicated ids in the DOM.
	 *
	 * @access private
	 *
	 * @param string $menu_html desktop menu html.
	 * @param string $slug menu item id.
	 *
	 * @return string
	 */
	private function fix_duplicated_ids($html, $slug) {
		$pattern    = '/id="' . $slug . '(\d+)"/';
		$id_counter = 1;

		// Replace duplicated IDs
		return preg_replace_callback(
			$pattern,
			function ($matches) use (&$id_counter, &$slug) {
				$id     = $matches[1];
				$new_id = $slug . $id . $id_counter++;
				return 'id="' . $new_id . '"';
			},
			$html
		);
	}

	/**
	 * Get Icon HTML.
	 *
	 * @access private
	 * @since 4.9.4
	 *
	 * @param array  $item  repeater item.
	 * @param string $type type.
	 *
	 * @return string
	 */
	private function get_icon_html($item, $type = '') {

		$html = '';

		if ('yes' !== $item['icon_switcher']) {
			return '';
		}

		$class = 'topppa-' . $type . 'item-icon ';

		if ('icon' === $item['icon_type']) {

			$icon_class = $class . $item['item_icon']['value'];
			// translators: %1$s is the icon class
			$html      .= sprintf('<i class="%1$s"></i>', esc_attr($icon_class));
		} elseif ('image' === $item['icon_type']) {

			$html .= '<img class="' . esc_attr($class) . '" src="' . esc_attr($item['item_image']['url']) . '" alt="' . esc_attr(Control_Media::get_image_alt($item['item_image'])) . '">';
		} else {

			$html .= '<div class="topppa-lottie-animation ' . esc_attr($class) . '" data-lottie-url="' . esc_attr($item['lottie_url']) . '" data-lottie-loop="true"></div>';
		}

		return $html;
	}

	/**
	 * Get Badge HTML.
	 *
	 * @access private
	 * @since 4.9.4
	 *
	 * @param array  $item  repeater item.
	 * @param string $type type.
	 *
	 * @return string
	 */
	private function get_badge_html($item, $type = '') {

		if ('yes' !== $item['badge_switcher']) {
			return '';
		}

		$class = 'topppa-' . $type . 'item-badge';

		$html = '<span class="' . esc_attr($class) . '">' . wp_kses_post($item['badge_text']) . '</span>';

		return $html;
	}
}
?>
