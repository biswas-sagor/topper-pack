<?php

use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Header Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Header_Menu_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'topppa_header_menu';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return TOPPPA_EPWB . esc_html__('Nav Menu', 'topper-pack');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu topppa-widget-icon';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Menu & Logo widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['topper-pack'];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the Menu & Logo widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'menu', 'header', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/service-widgets/header-menu/';
	}

	/**
	 * Register widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	/**
	 * Get available menus.
	 *
	 * Retrieve a list of available menus in the WordPress site.
	 *
	 * @since 1.0.0
	 * @access private
	 * @return array List of menu options with slug as key and name as value.
	 */
	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ($menus as $menu) {
			$options[$menu->slug] = $menu->name;
		}
		return $options;
	}

	protected function register_controls() {

		// <========================>  topppa MENU CONTENT <========================>
		$this->start_controls_section(
			'logo_settings',
			[
				'label' => esc_html__('Menu & Logo', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_menu_styles',
			[
				'label' => esc_html__('Menu Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'style_one' => esc_html__('Style One', 'topper-pack'),
					'style_two' => esc_html__('Style Two', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'av_header_one_active',
			[
				'label' => esc_html__('Header One Active', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Active', 'topper-pack'),
				'label_off' => esc_html__('Deactive', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('When use header one Please Active this option or disable it.', 'topper-pack'),
			]
		);
		$menus = $this->get_available_menus();
		if (!empty($menus)) {
			$this->add_control(
				'menu_select',
				[
					'label' => __('Menu', 'topper-pack'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys($menus)[0],
					'save_default' => true,
					'separator' => 'after',
					// translators: %s is the URL to the Menus screen in the WordPress admin.
					'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'topper-pack'), admin_url('nav-menus.php')), 
				]
			);
		} else {
			$this->add_control(
				'menu_select',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					// translators: %s is the URL to the Menus screen in the WordPress admin.
					'raw' => '<strong>' . __('There are no menus in your site.', 'topper-pack') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'topper-pack'), admin_url('nav-menus.php?action=edit&menu=0')), 
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
		$this->end_controls_section();

		// <===============> MOBILE MENU <===============>

		$this->start_controls_section(
			'topppa_mobile_menu_options',
			[
				'label' => esc_html__('Mobile Menu', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$menus = $this->get_available_menus();
		if (!empty($menus)) {
			$this->add_control(
				'mobile_menu_select',
				[
					'label' => __('Mobile Menu', 'topper-pack'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys($menus)[0],
					'save_default' => true,
					// translators: %s is the URL to the Menus screen in the WordPress admin.
					'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'topper-pack'), admin_url('nav-menus.php')), 
				]
			);
		} else {
			$this->add_control(
				'mobile_menu_select',
				[
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					// translators: %s is the URL to the Menus screen in the WordPress admin.
					'raw' => '<strong>' . __('There are no menus in your site.', 'topper-pack') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'topper-pack'), admin_url('nav-menus.php?action=edit&menu=0')), 
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
		$this->add_control(
			'mobile_logo_select',
			[
				'label' => esc_html__('Select Mobile Logo', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'topper-pack'),
					'custom' => esc_html__('Coustom Logo', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'mobile_logo',
			[
				'label'       => __('Logo', 'topper-pack'),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'label_block' => true,
				'condition' => [
					'mobile_logo_select' => 'custom',
				],
			]
		);
		$this->add_control(
			'topppa_mobile_menu_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-bars',
					'library' => 'fa-solid',
				],
			]
		);
		$this->end_controls_section();

		// <==============> MENU STYLES <===============>
		$this->start_controls_section(
			'menu_styles',
			[
				'label' => esc_html__('Menu Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'menu_box_style',
			[
				'label' => esc_html__('Menu Box', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'menu_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .main-menu-area>ul>li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .main-menu-area>ul>li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'main_menu_style',
			[
				'label' => esc_html__('Main Menu', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'menu_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area > ul > li > a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'menu_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area > ul > li > a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'menu_acolor',
			[
				'label'     => esc_html__('Active Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul ul.sub-menu li.current-menu-item a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typo',
				'selector' => '{{WRAPPER}} .main-menu-area > ul > li > a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .main-menu-area > ul > li > a',
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .main-menu-area > ul > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .main-menu-area > ul > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .main-menu-area > ul > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// <==========> SUB MENUS STYLES <==========>

		$this->start_controls_tabs(
			'menu_style_tabs'
		);
		$this->start_controls_tab(
			'sub_menu_tab',
			[
				'label' => esc_html__('Sub Menu', 'topper-pack'),
			]
		);
		$this->add_control(
			'sub_menu_box',
			[
				'label' => esc_html__('Sub Menu Box', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'sub_menu_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'sub_menu_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'sub_menu_style',
			[
				'label' => esc_html__('Sub Menu', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'submenu_typo',
				'selector' => '{{WRAPPER}} .main-menu-area ul.sub-menu li a',
			]
		);
		$this->add_responsive_control(
			'submenu_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_bg',
			[
				'label'     => esc_html__('Background', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_hbg',
			[
				'label'     => esc_html__('Hover Background', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_border',
			[
				'label'     => esc_html__('Border Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_align',
			[
				'label'     => esc_html__('Alignment', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'left',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_default_padding',
			[
				'label' => esc_html__('DefaultPadding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'submenu_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .main-menu-area ul.sub-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========> OFFCANVAS BUTTONS STYLES <==========>
		$this->start_controls_section(
			'mmenu_op_cl_styles',
			[
				'label' => esc_html__('Mobile Menu Close & Open Button', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'mmenu_open_close_tabs'
		);

		$this->start_controls_tab(
			'mmenu_open_tab',
			[
				'label' => esc_html__('Open', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'mmenu_op_btn_typo',
				'selector' => '{{WRAPPER}} .icon-btn',
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_bg',
			[
				'label' => esc_html__('Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_hbg',
			[
				'label' => esc_html__('Hover Background Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'mmenu_op_btn_border',
				'selector' => '{{WRAPPER}} .topppa-nav-menu-toggle',
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_op_btn_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-menu-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'mmenu_close_tab',
			[
				'label' => esc_html__('Close', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'mmenu_cl_btn_typography',
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close',
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_height',
			[
				'label' => esc_html__('Height', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'mmenu_cl_btn_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'mmenu_cl_btn_border',
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close',
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_cl_btn_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area button.topppa-nav-menu-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========> MOBILE MENUS STYLES <==========>
		$this->start_controls_section(
			'mmenu_full_box_styles',
			[
				'label' => esc_html__('Mobile Menu Box', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'mmenu_box_style',
			[
				'label' => esc_html__('Box Style', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'mmenu_bx_width',
			[
				'label' => esc_html__('Max Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'mmenu_bx_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'mmenu_bx_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-topppa-menu-area',
			]
		);
		$this->end_controls_section();

		// <==========> MOBILE MENUS STYLES <==========>
		$this->start_controls_section(
			'mobile_menu_styles',
			[
				'label' => esc_html__('Mobile Menu', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'mmenu_list_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'mobile_menu_tabs'
		);

		$this->start_controls_tab(
			'mobile_menu_logo_tab',
			[
				'label' => esc_html__('Logo', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'mobile_logo_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo',
			]
		);
		$this->add_responsive_control(
			'mobile_logo_width',
			[
				'label' => esc_html__('Width', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'mobile_logo_select!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_logo_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'mobile_logo_text_typo',
				'selector' => '{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo a',
				'condition' => [
					'mobile_logo_select' => '',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_logo_text_color',
			[
				'label' => esc_html__('Text Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'mobile_logo_select' => '',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_logo_text_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo a:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'mobile_logo_select' => '',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_logo_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_logo_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .topppa-nav-mobile-menu-wrapper .mobile-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'mobile_menu_tab',
			[
				'label' => esc_html__('Menu', 'topper-pack'),
			]
		);

		$this->add_control(
			'mmenu_list_wrp_spacing',
			[
				'label' => esc_html__('Menu List Wrapper Spacing', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'mmenu_list_wrp_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu>ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_wrp_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu>ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'mmenu_list_typo',
				'selector' => '{{WRAPPER}} .mobile-menu ul li a',
			]
		);
		$this->add_responsive_control(
			'mmenu_list_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_active',
			[
				'label' => esc_html__('Active Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul li.active-class>a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'mmenu_list_dbg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .mobile-menu ul li a',
			]
		);
		$this->add_responsive_control(
			'mmenu_list_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'mmenu_list_icon_tab',
			[
				'label' => esc_html__('Menu Icon', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'mmenu_list_icon_width',
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
					'{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_icon_height',
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
					'{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_icon_align',
			[
				'label' => esc_html__('Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'mmenu_list_icon_border',
				'selector' => '{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class',
			]
		);
		$this->add_responsive_control(
			'mmenu_list_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_icon_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mmenu_list_icon_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .mobile-menu ul .submenu-item-has-children>a .mean-expand-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_html = [
			'a'      => ['href' => [], 'title' => []],
			'br'     => [],
			'em'     => [],
			'strong' => [],
		];
		// Your widget output here
?>

		<!-- Mobile Menu -->

		<div class="topppa-nav-mobile-menu-wrapper">
			<div class="mobile-topppa-menu-area text-center">
				<button class="topppa-nav-menu-close"><i class="fas fa-times"></i></button>
				<div class="mobile-logo">
					<?php
					if ($settings['mobile_logo_select'] == 'custom') { ?>
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<?php
							$logo_alt = get_post_meta($settings['mobile_logo']['id'], '_wp_attachment_image_alt', true);
							$logo_title = get_the_title($settings['mobile_logo']['id']);
							?>
							<?php echo wp_get_attachment_image($settings['mobile_logo']['id'], 'full', false, array(
								'alt' => esc_attr($logo_alt),
								'title' => esc_attr($logo_title),
							)); ?>
						</a>

					<?php } elseif (has_custom_logo()) {
						the_custom_logo();
					} else {
					?>
						<h2>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php esc_html(bloginfo('name')); ?>
							</a>
						</h2>
					<?php  } ?>
				</div>
				<div class="mobile-menu">
					<?php
					if ($settings['mobile_menu_select']) {
						$mobile_menu = $settings['mobile_menu_select'];
					} else {
						$mobile_menu = '';
					}
					wp_nav_menu(
						array(
							'menu'           => $mobile_menu,
							'container'      => false,
							'theme_location' => 'mainmenu',
							'menu_id'        => 'mainmenu',
							'menu_class'     => '',
						)
					);
					?>
				</div>
			</div>
		</div>

		<!-- end Mobile menu -->
		<div class="topppa-menu-area">
			<div class="container">
				<nav class="main-menu-area <?php echo esc_attr($settings['topppa_menu_styles'] === 'style_one' ? 'topppa-main-menu' : 'topppa-main-menu-v2'); ?> d-none d-lg-inline-block">
					<?php
					if ($settings['menu_select']) {
						$header_menu = $settings['menu_select'];
					} else {
						$header_menu = '';
					}
					wp_nav_menu(
						array(
							'menu'           => $header_menu,
							'container'      => false,
							'theme_location' => 'mainmenu',
							'menu_id'        => 'mainmenu',
							'menu_class'     => '',
						)
					);
					?>
				</nav>
				<div class="navbar-right d-inline-flex d-lg-none">
					<button type="button" class="topppa-nav-menu-toggle icon-btn"><?php \Elementor\Icons_Manager::render_icon($settings['topppa_mobile_menu_icon']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor ?></button>
				</div>
			</div>
		</div>

<?php
	}
}
