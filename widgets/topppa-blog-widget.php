<?php

use TopperPack\Trait_Loader\Global_Component_Loader;
use \TopperPack\Includes\Controls\Controls_Manager as TopperPack_Controls_Manager;
use TopperPack\Includes\Utilities;

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor topppa Blog Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class TOPPPA_Blog_Widget extends \Elementor\Widget_Base {

	/**
	 * Global Component Loader
	 *
	 * @package TopperPack
	 */
	use Global_Component_Loader;

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
		return 'topppa_blog';
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
		return TOPPPA_EPWB . esc_html__('Blog', 'topper-pack');
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
		return 'eicon-post';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
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
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['topppa', 'widget', 'blog', 'post', 'topperpack'];
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
		return 'https://doc.topperpack.com/docs/post-widgets/blog/';
	}

	public function topppa_blog_date_format() {
		$this->add_control(
			'date_format',
			[
				'label' => __('Date Format', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'F j, Y',
				'options' => [
					'F j, Y'    => date_i18n(esc_html__('F j, Y', 'topper-pack')),
					'Y-m-d'     => date_i18n(esc_html__('Y-m-d', 'topper-pack')),
					'pro_date_format_1'   => esc_html__('Y, M, D (Pro)', 'topper-pack'),
					'pro_date_format_2'     => esc_html__('m/d/Y (Pro)', 'topper-pack'),
					'pro_date_format_3'     => esc_html__('d/m/Y (Pro)', 'topper-pack'),
					'pro_date_format_4'    => esc_html__('j. F y (Pro)', 'topper-pack'),
				],
			]
		);
		Utilities::upgrade_pro_notice(
			$this,
			\Elementor\Controls_Manager::RAW_HTML,
			'date_format',
			'date_format',
			['pro_date_format_1', 'pro_date_format_2', 'pro_date_format_3', 'pro_date_format_4']
		);
	}

	/**
	 * Get custom URL for image.
	 *
	 * Retrieve a URL where the user can get more information about the image.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget image URL.
	 */
	public function get_custom_image_url() {
		return 'https://topperpack.com/assets/widgets/blog-widget/';
	}

	/**
	 * Register Blog widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$base_url = $this->get_custom_image_url();

		$this->start_controls_section(
			'topppa_blog_style',
			[
				'label' => esc_html__('Styles', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'topppa_blog_styles',
			[
				'label' => esc_html__('Choose Style', 'topper-pack'),
				'type' => TopperPack_Controls_Manager::IMAGECHOOSE,
				'default' => 'style_one',
				'options' => [
					'style_one' => [
						'title' => esc_html__('Style 1', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-1.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-1.jpg',
						'width' => '100%',
					],
					'style_two' => [
						'title' => esc_html__('style 2', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-2.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-2.jpg',
						'width' => '100%',
					],
					'style_three' => [
						'title' => esc_html__('Style 3', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-3.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-3.jpg',
						'width' => '100%',
					],
					'style_four' => [
						'title' => esc_html__('Style 4', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-4.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-4.jpg',
						'width' => '100%',
					],
					'style_five' => [
						'title' => esc_html__('Style 5', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-1.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-1.jpg',
						'width' => '100%',
					],
					'style_six' => [
						'title' => esc_html__('Style 6', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-5.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-5.jpg',
						'width' => '100%',
					],
					'style_seven' => [
						'title' => esc_html__('Style 7', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-6.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-6.jpg',
						'width' => '100%',
					],
					'style_eight' => [
						'title' => esc_html__('Style 8', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-7.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-7.jpg',
						'width' => '100%',
					],
					'style_nine' => [
						'title' => esc_html__('Style 9', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-7.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-7.jpg',
						'width' => '100%',
					],
					'style_ten' => [
						'title' => esc_html__('Style 10', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-7.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-7.jpg',
						'width' => '100%',
					],
					'style_eleven' => [
						'title' => esc_html__('Style 11', 'topper-pack'),
						'imagelarge' => $base_url . 'topppa-blog-post-7.jpg',
						'imagesmall' => $base_url . 'topppa-blog-post-7.jpg',
						'width' => '100%',
					],
				],
			]
		);
		$this->end_controls_section();

		// <========================> CONTENT TAB START <========================>
		$this->start_controls_section(
			'post_query_section',
			[
				'label' => esc_html__('Post Query', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Get all categories
		$categories = get_terms(array(
			'taxonomy'   => 'category',
			'hide_empty' => false,
		));
		$cat_options = [];
		foreach ($categories as $category) {
			$cat_options[$category->term_id] = $category->name;
		}

		// Get all tags
		$tags = get_terms(array(
			'taxonomy'   => 'post_tag',
			'hide_empty' => false,
		));
		$tag_options = [];
		foreach ($tags as $tag) {
			$tag_options[$tag->term_id] = $tag->name;
		}

		// Get all post types
		$post_types = get_post_types(['public' => true], 'objects');
		$post_type_options = [];
		foreach ($post_types as $post_type) {
			$post_type_options[$post_type->name] = $post_type->label;
		}

		// Get authors (Fixed: 'who' => 'authors' is deprecated)
		$authors = get_users([
			'capability' => 'edit_posts',
			'has_published_posts' => true,
		]);
		$author_options = [];
		foreach ($authors as $author) {
			$author_options[$author->ID] = $author->display_name;
		}

		// Controls
		$this->add_control(
			'post_type',
			[
				'label' => esc_html__('Post Type', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $post_type_options,
				'default' => 'post',
			]
		);

		$this->add_control(
			'select_filter',
			[
				'label' => esc_html__('Select Filter', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'topper-pack'),
					'cat' => esc_html__('Post By Category', 'topper-pack'),
					'tag' => esc_html__('Post By Tag', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'postby_cat',
			[
				'label' => esc_html__('Select Category', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $cat_options,
				'condition' => [
					'select_filter' => 'cat',
				],
			]
		);

		$this->add_control(
			'postby_tag',
			[
				'label' => esc_html__('Select Tags', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $tag_options,
				'condition' => [
					'select_filter' => 'tag',
				],
			]
		);

		$this->add_control(
			'authors',
			[
				'label' => esc_html__('Filter by Author', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $author_options,
				'label_block' => true,
			]
		);

		$this->add_control(
			'display_item',
			[
				'label' => esc_html__('Display Item', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 50,
				'step' => 1,
				'default' => 10,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__('Post Order', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'none'          => esc_html__('None', 'topper-pack'),
					'ID'            => esc_html__('ID', 'topper-pack'),
					'date'          => esc_html__('Date', 'topper-pack'),
					'name'          => esc_html__('Name', 'topper-pack'),
					'title'         => esc_html__('Title', 'topper-pack'),
					'comment_count' => esc_html__('Comment count', 'topper-pack'),
					'rand'          => esc_html__('Random', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__('Order By', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC'  => esc_html__('ASC', 'topper-pack'),
					'DESC' => esc_html__('DESC', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'ignore_sticky',
			[
				'label' => esc_html__('Ignore Sticky Posts', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => esc_html__('Yes', 'topper-pack'),
					'no' => esc_html__('No', 'topper-pack'),
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => esc_html__('Offset', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 300,
				'step' => 1,
				'default' => 0,
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'post_options',
			[
				'label' => esc_html__('Post Options', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->topppa_global_title_tag();

		$this->add_control(
			'title_length',
			[
				'label' => esc_html__('Title Length', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 3,
				'max' => 100,
				'step' => 1,
				'default' => 6,
			]
		);
		$this->add_control(
			'enable_post_desc',
			[
				'label' => esc_html__('Enable Description', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dec_length',
			[
				'label'   => esc_html__('Content Length ', 'topper-pack'),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'default' => 12,
				'condition' => [
					'enable_post_desc' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_meta',
			[
				'label' => esc_html__('Enable Post meta', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_meta',
			[
				'label' => esc_html__('Select Post Meta', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'date' => esc_html__('Date', 'topper-pack'),
					'author'  => esc_html__('Author', 'topper-pack'),
					'comment' => esc_html__('Comment', 'topper-pack'),
					'fcategory' => esc_html__('First Category', 'topper-pack'),
					'reading_time' => esc_html__('Reading time', 'topper-pack'),
				],
				'default' => ['date', 'author', 'fcategory'],
				'condition' => [
					'enable_meta' => 'yes',
				],
			]
		);
		$this->add_control(
			'enable_category',
			[
				'label' => esc_html__('Enable Category', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'topppa_blog_styles' => 'style_ten',
				],
			]
		);
		$this->topppa_blog_date_format();

		$this->end_controls_section();

		$this->start_controls_section(
			'post_meta_in_img',
			[
				'label' => esc_html__('Post Meta In Image', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_img_post_meta',
			[
				'label' => esc_html__('Enable Image Meta', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'img_post_meta',
			[
				'label' => esc_html__('Select Post Meta', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => [
					'date' => esc_html__('Date', 'topper-pack'),
					'author'  => esc_html__('Author', 'topper-pack'),
					'comment' => esc_html__('Comment', 'topper-pack'),
					'fcategory' => esc_html__('First Category', 'topper-pack'),
					'reading_time' => esc_html__('Reading time', 'topper-pack'),
				],
				'default' => ['date'],
				'condition' => [
					'enable_img_post_meta' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'btn_options',
			[
				'label' => esc_html__('Post Button', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'enable_post_btn',
			[
				'label' => esc_html__('Enable Button', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->topppa_get_global_button_effects_controls([
			'enable_post_btn' => 'yes',
		]);

		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('View All', 'topper-pack'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'enable_post_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_btn_icon',
			[
				'label' => esc_html__('Show Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'topper-pack'),
				'label_off' => esc_html__('Hide', 'topper-pack'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'enable_post_btn' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_post_btn' => 'yes',
					'show_btn_icon' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'blog_post_meta_icon',
			[
				'label' => esc_html__('Meta Icons', 'topper-pack'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'date_icon',
			[
				'label' => esc_html__('Date Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-calendar-week',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_meta' => 'yes',
					'post_meta' => 'date'
				]
			]
		);
		$this->add_control(
			'author_icon',
			[
				'label' => esc_html__('Author Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-user',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_meta' => 'yes',
					'post_meta' => 'author'
				]
			]
		);
		$this->add_control(
			'cat_icon',
			[
				'label' => esc_html__('Category Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-folder',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_meta' => 'yes',
					'post_meta' => 'fcategory'
				]
			]
		);
		$this->add_control(
			'comment_icon',
			[
				'label' => esc_html__('Comment Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-comments',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_meta' => 'yes',
					'post_meta' => 'comment'
				]
			]
		);
		$this->add_control(
			'reading_time_icon',
			[
				'label' => esc_html__('Time Icon', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-clock',
					'library' => 'fa-solid',
				],
				'condition' => [
					'enable_meta' => 'yes',
					'post_meta' => 'reading_time'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'slider_options',
			[
				'label' => esc_html__('Options', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->topppa_global_image_animation();


		$this->add_responsive_control(
			'anim_bg_color',
			[
				'label' => esc_html__('Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .image-anim' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'column_options',
			[
				'label' => esc_html__('Column Options', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desktop_col',
			[
				'label' => esc_html__('Columns On Desktop', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-xl-6',
				'options' => [
					'col-xl-12'  => esc_html__('1 Column', 'topper-pack'),
					'col-xl-6'  => esc_html__('2 Column', 'topper-pack'),
					'col-xl-4'  => esc_html__('3 Column', 'topper-pack'),
					'col-xl-3'  => esc_html__('4 Column', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'ipadpro_col',
			[
				'label' => esc_html__('Columns On Ipad Pro', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-lg-6',
				'options' => [
					'col-lg-12'  => esc_html__('1 Column', 'topper-pack'),
					'col-lg-6'  => esc_html__('2 Column', 'topper-pack'),
					'col-lg-4'  => esc_html__('3 Column', 'topper-pack'),
					'col-lg-3'  => esc_html__('4 Column', 'topper-pack'),
				],
			]
		);
		$this->add_control(
			'tab_col',
			[
				'label' => esc_html__('Columns On Tablet', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'col-md-12',
				'options' => [
					'col-md-12'  => esc_html__('1 Column', 'topper-pack'),
					'col-md-6'  => esc_html__('2 Column', 'topper-pack'),
					'col-md-4'  => esc_html__('3 Column', 'topper-pack'),
					'col-md-3'  => esc_html__('4 Column', 'topper-pack'),
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'box_styles',
			[
				'label' => esc_html__('Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'box_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('None', 'topper-pack'),
					'row' => esc_html__('Row', 'topper-pack'),
					'row-reverse' => esc_html__('Row Reverse', 'topper-pack'),
					'column' => esc_html__('Column', 'topper-pack'),
					'column-reverse' => esc_html__('Column Reverse', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'align_items',
			[
				'label' => esc_html__('Align Items', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-align-center-h',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-align-end-v',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'box_direction' => ['row', 'row-reverse']
				]
			]
		);
		$this->add_responsive_control(
			'box_text_align',
			[
				'label' => esc_html__('Text Alignment', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'topper-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_gap',
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
					'{{WRAPPER}} .topppa-post-card' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card',
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE STYLES <==========>

		$this->start_controls_section(
			'card_img_style',
			[
				'label' => esc_html__('Image', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'card_img_height',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img .post-img img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_blog_styles!' => 'style_nine',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_width',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img .post-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_blog_styles!' => 'style_nine',
				],
			]
		);

		$this->add_responsive_control(
			'card_img_height2',
			[
				'label'      => esc_html__('Height', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_blog_styles' => 'style_nine',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_width2',
			[
				'label'      => esc_html__('Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_blog_styles' => 'style_nine',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_min_width2',
			[
				'label'      => esc_html__('Min Width', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'custom'],
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
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img' => 'min-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'topppa_blog_styles' => 'style_nine',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_object',
			[
				'label' => esc_html__('Object Fit', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cover',
				'options' => [
					'fill'  => esc_html__('Fill', 'topper-pack'),
					'contain' => esc_html__('Contain', 'topper-pack'),
					'cover' => esc_html__('Cover', 'topper-pack'),
					'none' => esc_html__('None', 'topper-pack'),
				],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img .post-img img' => 'object-fit: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'card_img_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-card-img',
			]
		);
		$this->add_responsive_control(
			'card_img_border_radius',
			[
				'label'      => esc_html__('Image Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_wrapper_border_radius',
			[
				'label'      => esc_html__('Wrapper Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'card_img_shadow',
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-card-img',
			]
		);
		// multiple shadow
		$this->add_control(
			'enable_double_shadow',
			[
				'label'        => esc_html__('Enable Double Shadow', 'topper-pack'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Yes', 'topper-pack'),
				'label_off'    => esc_html__('No', 'topper-pack'),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		// Shadow #1
		$this->add_control(
			'shadow1',
			[
				'label'     => esc_html__('Shadow 1', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);

		// Shadow #2
		$this->add_control(
			'shadow2',
			[
				'label'     => esc_html__('Shadow 2', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::BOX_SHADOW,
				'condition' => [
					'enable_double_shadow' => 'yes',
				],
				'selectors' => [],
			]
		);
		$this->add_responsive_control(
			'card_img_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'card_img_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-card-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> BOX STYLES <==========>

		$this->start_controls_section(
			'content_box_styles',
			[
				'label' => esc_html__('Content Box', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_box_bg',
				'label' => esc_html__('Background', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_box_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap',
			]
		);
		$this->add_responsive_control(
			'content_box_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap',
			]
		);
		$this->add_responsive_control(
			'content_box_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> META STYLES <==========>
		$this->start_controls_section(
			'meta_content',
			[
				'label' => esc_html__('Meta Content', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_blog_styles!' => ['style_nine', 'style_ten']
				]
			]
		);
		$this->add_responsive_control(
			'meta_content_gap',
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
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_meta_direction',
			[
				'label' => esc_html__('Direction', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Row', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
					'row-reverse' => [
						'title' => esc_html__('Row Reverse', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul' => 'flex-direction: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_meta_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_meta_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta',
			]
		);
		$this->add_responsive_control(
			'content_meta_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_meta_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta',
			]
		);
		$this->add_responsive_control(
			'content_meta_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_meta_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'meta_content_style_tabs'
		);
		$this->start_controls_tab(
			'post_meta_style_tab',
			[
				'label' => esc_html__('Meta', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typo',
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li a',
			]
		);
		$this->add_responsive_control(
			'post_meta_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_meta_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_meta_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_meta_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_icon_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_icon_typo',
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li i',
			]
		);
		$this->add_responsive_control(
			'post_icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_icon_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card:hover .topppa-post-card-img .topppa-post-content-wrap .post-meta li i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_icon_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_icon_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// <==========>
		// <==========> META STYLES <==========>
		$this->start_controls_section(
			'meta_content2',
			[
				'label' => esc_html__('Meta Content', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_blog_styles' => ['style_nine', 'style_ten']
				]
			]
		);
		$this->add_responsive_control(
			'meta_content_gap2',
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
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->start_controls_tabs(
			'meta_content_style_tabs2'
		);
		$this->start_controls_tab(
			'post_meta_style_tab2',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typo2',
				'label'    => esc_html__('Text Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li a',
			]
		);
		$this->add_responsive_control(
			'post_meta_color2',
			[
				'label'     => esc_html__('Text Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_icon_typo2',
				'label'    => esc_html__('Icon Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li i',
			]
		);
		$this->add_responsive_control(
			'post_icon_color2',
			[
				'label'     => esc_html__('Icon Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_meta_bg_color2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_meta_border2',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li',
			]
		);
		$this->add_responsive_control(
			'content_meta_radius2',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_meta_shadow2',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li',
			]
		);
		$this->add_responsive_control(
			'content_meta_padding2',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_icon_tab2',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'post_meta_color2_hover',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_meta_bg_color2_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_meta_border2_hover',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover',
			]
		);
		$this->add_responsive_control(
			'content_meta_radius2_hover',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_meta_shadow2_hover',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover',
			]
		);
		$this->add_responsive_control(
			'content_meta_padding2_hover',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta ul li:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'content_meta_margin2',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> IMAGE META STYLES <==========>
		$this->start_controls_section(
			'img_meta_content',
			[
				'label' => esc_html__('Image Meta Content', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_img_post_meta' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_img_meta_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .post-img-meta',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_img_meta_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .post-img-meta',
			]
		);
		$this->add_responsive_control(
			'content_img_meta_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .post-img-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_img_meta_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .post-img-meta',
			]
		);
		$this->add_responsive_control(
			'content_img_meta_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .post-img-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_img_meta_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .post-img-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'img_meta_content_style_tabs'
		);
		$this->start_controls_tab(
			'post_img_meta_style_tab',
			[
				'label' => esc_html__('Meta', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_img_meta_typo',
				'selector' => '{{WRAPPER}} .post-img-meta ul li',
			]
		);
		$this->add_responsive_control(
			'post_img_meta_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-img-meta ul li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .post-img-meta ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_img_meta_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-img-meta ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_img_meta_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .post-img-meta ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_img_meta_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .post-img-meta ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_img_meta_icon_tab',
			[
				'label' => esc_html__('Icon', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'img_meta_icon_typo',
				'selector' => '{{WRAPPER}} .post-img-meta ul li i',
			]
		);
		$this->add_responsive_control(
			'img_meta_icon_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post-img-meta ul li i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'img_meta_icon_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .post-img-meta ul li i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'img_meta_icon_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .post-img-meta ul li i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'category_meta_content',
			[
				'label' => esc_html__('Category Content', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'topppa_blog_styles' => ['style_ten']
				]
			]
		);
		$this->add_responsive_control(
			'category_meta_gap',
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
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'category_meta_style_tabs'
		);
		$this->start_controls_tab(
			'category_meta_style_tab',
			[
				'label' => esc_html__('Normal', 'topper-pack'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'category_meta_typo',
				'label'    => esc_html__('Icon Typography', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a',
			]
		);
		$this->add_responsive_control(
			'category_meta_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'category_meta_bg_color',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'category_meta_border',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a',
			]
		);
		$this->add_responsive_control(
			'category_meta_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_meta_shadow',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'category_mata_tab_hover',
			[
				'label' => esc_html__('Hover', 'topper-pack'),
			]
		);
		$this->add_responsive_control(
			'category_mata_color_hover',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'category_mata_bg_color_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'category_mata_border_hover',
				'label' => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a:hover',
			]
		);
		$this->add_responsive_control(
			'category_mata__radius_hover',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'category_mata_shadow_hover',
				'label' => esc_html__('Box Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a:hover',
			]
		);
		$this->add_responsive_control(
			'category_mata__padding_hover',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'category_meta_padding',
			[
				'label' => esc_html__('Padding', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'category_mata_margin',
			[
				'label' => esc_html__('Margin', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		// <==========>
		// <==========> TITLE STYLES <==========>

		$this->start_controls_section(
			'post_title_styles',
			[
				'label' => esc_html__('Title', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_title_typo',
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-title',
			]
		);
		$this->add_responsive_control(
			'post_title_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_title_hcolor',
			[
				'label'     => esc_html__('Hover Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_title_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_title_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <==========>
		// <==========> DESCRIPTION STYLES <==========>

		$this->start_controls_section(
			'post_desc_styles',
			[
				'label' => esc_html__('Description', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'post_desc_typo',
				'selector' => '{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-desc',
			]
		);
		$this->add_responsive_control(
			'post_desc_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'post_desc_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'post_desc_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-post-card .topppa-post-content-wrap .topppa-post-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// <========================> BUTTON STYLES <========================>
		$this->start_controls_section(
			'topppa_btn_style',
			[
				'label' => esc_html__('Button', 'topper-pack'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_post_btn' => 'yes'
				]
			]
		);
		$this->add_control(
			'topppa_btn_icon_position',
			[
				'label' => esc_html__('Icon Position', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'row' => [
						'title' => esc_html__('Left', 'topper-pack'),
						'icon' => 'eicon-h-align-left',
					],
					'row-reverse' => [
						'title' => esc_html__('Right', 'topper-pack'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'row',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn' => 'flex-direction: {{VALUE}};',
				],
				'condition' => [
					'show_btn_icon' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_gap',
			[
				'label'      => esc_html__('Icon Gap', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_btn_icon' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'topppa_btn_content_tabs'
		);

		$this->start_controls_tab(
			'topppa_btn_normal',
			[
				'label' => __('Normal', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_typo',
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn',
			]
		);

		$this->add_control(
			'topppa_btn_icon_styles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_width',
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
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_height',
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
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'topppa_btn_icon_content_typography',
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_content_color',
			[
				'label' => esc_html__('Icon Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_bg',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon',
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_border_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_margin',
			[
				'label'      => esc_html__('Margin', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'topppa_btn_padding',
			[
				'label'      => esc_html__('Padding', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'topppa_btn_hover',
			[
				'label' => __('Hover', 'topper-pack'),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'topppa_btn_typography_hover',
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_color_hover',
			[
				'label'     => esc_html__('Color', 'topper-pack'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover',
				'condition' => [
					'topppa_btn_styles' => ['style_three', 'style_six', 'style_seven']
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_background_hover2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn::before, {{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn::after',
				'condition' => [
					'topppa_btn_styles!' => ['style_three', 'style_six', 'style_seven', 'style_twelve'],
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'topppa_btn_border_hover',
				'label'    => esc_html__('Border', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_border_radius_hover',
			[
				'label'      => esc_html__('Border Radius', 'topper-pack'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors'  => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'topppa_btn_box_shadow_hover',
				'label'    => esc_html__('Shadow', 'topper-pack'),
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover',
			]
		);

		$this->add_control(
			'topppa_btn_icon_hstyles',
			[
				'label' => esc_html__('Icon Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'topppa_btn_icon_hborder_radius',
			[
				'label' => esc_html__('Border Radius', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover .btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'topppa_btn_icon_hcolor',
			[
				'label' => esc_html__('Hover Color', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn:hover .btn-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor2',
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-blog-btn-wrapper .topppa-btn .btn-icon::before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'topppa_btn_icon_hbgcolor',
				'label' => esc_html__('Hover Background 2', 'topper-pack'),
				'types' => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .topppa-btn-wrapper .topppa-btn:hover .btn-icon',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Hover Background 2', 'topper-pack'),
					],
				],
				'condition' => [
					'show_btn_icon' => 'yes'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render logo widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	// class এর ভিতরে: (public/protected যেটা চাইলে)
	protected function topper_pack_estimated_reading_time($post_id = null) {
		if (! $post_id) {
			global $post;
			if (empty($post) || ! isset($post->ID)) {
				return ''; // no post context
			}
			$post_id = $post->ID;
		}

		$content = get_post_field('post_content', $post_id);
		if (empty($content)) {
			return '';
		}

		$word_count = str_word_count(wp_strip_all_tags($content));
		$wpm = 200; // Average words per minute
		$reading_time = (int) ceil($word_count / $wpm);

		//  text sanitized output
		$output = esc_html($reading_time) . ' ' . esc_html__('min read', 'topper-pack');

		return $output;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_html = [
			'a'      => ['href' => []],
			'br'     => [],
			'em'     => [],
			'strong' => [],
		];

		// multiple shadow
		if ('yes' === $settings['enable_double_shadow']) {

			$shadow1 = $settings['shadow1'];
			$shadow2 = $settings['shadow2'];

			$css_shadow1 = "{$shadow1['horizontal']}px {$shadow1['vertical']}px {$shadow1['blur']}px {$shadow1['spread']}px {$shadow1['color']}";
			$css_shadow2 = "{$shadow2['horizontal']}px {$shadow2['vertical']}px {$shadow2['blur']}px {$shadow2['spread']}px {$shadow2['color']}";

			$box_shadow = $css_shadow1 . ', ' . $css_shadow2;
		} else {
			$box_shadow = 'none';
		}

		// Button Style Classes
		$style_classes = [
			'style_one' => 'style-one',
			'style_two' => 'style-two',
			'style_three' => 'style-three',
			'style_four' => 'style-four',
			'style_five' => 'style-five',
			'style_six' => 'style-six',
			'style_seven' => 'style-seven',
			'style_eight' => 'style-eight',
			'style_nine' => 'style-nine',
			'style_ten' => 'style-ten',
			'style_eleven' => 'style-eleven',
			'style_twelve' => 'style-twelve',
			'style_thirteen' => 'style-thirteen',
			'style_fourteen' => 'style-fourteen',
			'style_fifteen' => 'style-fifteen',
		];
		// Get the class name based on the selected style or fallback to an empty string.
		$class = isset($style_classes[$settings['topppa_blog_styles']]) ? $style_classes[$settings['topppa_blog_styles']] : '';
		$btn_class = isset($style_classes[$settings['topppa_btn_styles']]) ? $style_classes[$settings['topppa_btn_styles']] : '';

		// Query the posts
		$args = array(
			'post_type' => 'post',
			'post_status' => array('publish'),
			'posts_per_page' => $settings['display_item'],
			'ignore_sticky_posts' => $settings['ignore_sticky'],
			'offset' => $settings['offset'],
			'order' => $settings['order'],
			'orderby' => $settings['orderby'],
		);

		// Initialize tax_query
		$tax_query = array(); // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

		// Check if 'cat' filter is selected and 'postby_cat' is not empty
		if ('cat' == $settings['select_filter'] && !empty($settings['postby_cat'])) {
			$tax_query[] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'taxonomy' => 'category',
				'field' => 'term_id',
				'terms'    => $settings['postby_cat'],
			);
		}

		// Check if 'tag' filter is selected and 'postby_tag' is not empty
		if ('tag' == $settings['select_filter'] && !empty($settings['postby_tag'])) {
			$tax_query[] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'taxonomy' => 'post_tag',
				'field' => 'term_id',
				'terms'    => $settings['postby_tag'],
			);
		}

		// If there are any taxonomy queries, add them to $args
		if (!empty($tax_query)) {
			$args['tax_query'] = $tax_query; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		}

		// Query the posts
		$query = new \WP_Query($args);
		$column = $settings['desktop_col'] . ' ' . $settings['ipadpro_col'] . ' ' . $settings['tab_col'];
?>
		<div class="topppa-blog-post-wrapper">
			<div class="row">
				<?php
				if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post();
				?>
						<div class="<?php echo esc_attr($column); ?>">
							<div class="topppa-post-card <?php echo esc_attr($class); ?>">
								<div class="topppa-post-card-img" style="box-shadow: <?php echo esc_attr($box_shadow); ?>;">

									<!-- IMAGE SHAPES -->
									<?php if ($settings['post_img_anim'] === 'anim_one' || $settings['post_img_anim'] === 'anim_rotate') : ?>
										<span class="image-anim image-anim1 <?php echo esc_attr($settings['post_img_anim'] === 'anim_rotate' ? 'v2' : ''); ?>"></span>
									<?php endif; ?>

									<?php if ($settings['post_img_anim'] === 'anim_two') : ?>
										<span class="image-anim image-anim2"></span>
									<?php endif; ?>

									<?php if ($settings['post_img_anim'] === 'anim_three') : ?>
										<span class="image-anim image-anim3"></span>
									<?php endif; ?>

									<!-- START POST META IN IMAGE -->
									<?php if ($settings['enable_img_post_meta'] === 'yes') : ?>
										<div class="post-img-meta <?php echo esc_attr(in_array('date', $settings['img_post_meta']) ? 'post-img-meta-v2' : ''); ?>">
											<?php if (!empty($settings['enable_meta']) && $settings['enable_meta'] === 'yes') : ?>
												<?php
												$dpost_meta = !empty($settings['img_post_meta']) && is_array($settings['img_post_meta'])
													? $settings['img_post_meta']
													: ['date', 'author', 'fcategory', 'comment', 'category'];
												?>
												<ul>
													<!-- META DATE -->
													<?php if (in_array('date', $dpost_meta)) :
														$date_format = $settings['date_format'] ?? 'F j, Y';
														$post_date = get_the_date('Y-m-d');
														$date_archive_link = get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'));
													?>
														<li>
															<?php if ($settings['topppa_blog_styles'] !== 'style_six') : ?>
																<?php
																if (!empty($settings['date_icon']['value'])) {
																	\Elementor\Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
																}
																?>
																<a href="<?php echo esc_url($date_archive_link); ?>" class="topppa-post-date"><?php echo esc_html(get_the_date($date_format)); ?></a>
															<?php else: ?>
																<a href="<?php echo esc_url($date_archive_link); ?>" class="topppa-post-date">
																	<span class="date post-p-day"><?php echo esc_html(get_the_date('F')); ?></span>
																	<span class="date post-p-year"><?php echo esc_html(get_the_date('Y')); ?></span>
																</a>
															<?php endif; ?>
														</li>
													<?php endif; ?>

													<!-- META AUTHOR -->
													<?php if (in_array('author', $dpost_meta)) : ?>
														<li>
															<?php
															if (!empty($settings['author_icon']['value'])) {
																\Elementor\Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
															}
															?>
															<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="topppa-post-author"><?php the_author(); ?></a>
														</li>
													<?php endif; ?>

													<!-- META FIRST CATEGORY -->
													<?php if (in_array('fcategory', $dpost_meta)) : ?>
														<li>
															<?php
															if (!empty($settings['cat_icon']['value'])) {
																\Elementor\Icons_Manager::render_icon($settings['cat_icon'], ['aria-hidden' => 'true']);
															}
															?>
															<?php
															$categories = get_the_category();
															if (!empty($categories)) {
																$category_link = get_category_link($categories[0]->term_id);
																echo '<a href="' . esc_url($category_link) . '" class="topppa-post-cat">' . esc_html($categories[0]->name) . '</a>';
															}
															?>
														</li>
													<?php endif; ?>

													<!-- META COMMENT -->
													<?php if (in_array('comment', $dpost_meta)) : ?>
														<li>
															<?php
															if (!empty($settings['comment_icon']['value'])) {
																\Elementor\Icons_Manager::render_icon($settings['comment_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
															}
															?>
															<?php echo esc_html(get_comments_number()); ?> <?php esc_html_e('Comments', 'topper-pack'); ?>
														</li>
													<?php endif; ?>
													<?php if (in_array('reading_time', $dpost_meta)) : ?>
														<li>
															<?php if (!empty($settings['reading_time_icon']['value'])) {
																\Elementor\Icons_Manager::render_icon($settings['reading_time_icon'], ['aria-hidden' => 'true']);
															} ?>
															<?php echo $this->topper_pack_estimated_reading_time(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?>
														</li>
													<?php endif; ?>
												</ul>
											<?php endif; ?>
										</div>
									<?php endif; ?>

									<a href="<?php the_permalink(); ?>" class="post-img"> <?php the_post_thumbnail('', array('class' => 'img-responsive')); ?>
									</a>

									<?php if ($settings['topppa_blog_styles'] === 'style_seven' || $settings['topppa_blog_styles'] === 'style_eight') : ?>
										<div class="topppa-post-content-wrap">
											<?php if ($settings['topppa_blog_styles'] !== 'style_three') : ?>
												<div class="post-meta">
													<?php if (!empty($settings['enable_meta']) && $settings['enable_meta'] === 'yes') : ?>
														<?php
														$dpost_meta = !empty($settings['post_meta']) && is_array($settings['post_meta'])
															? $settings['post_meta']
															: ['date', 'author', 'fcategory', 'comment', 'category'];
														?>
														<ul>
															<?php if (in_array('date', $dpost_meta) && $settings['topppa_blog_styles'] !== 'style_three') : ?>
																<li>
																	<?php
																	if (!empty($settings['date_icon']['value'])) {
																		\Elementor\Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
																	}
																	?>
																	<?php
																	$date_format = $settings['date_format'] ?? 'F j, Y';
																	$post_date = get_the_date('Y-m-d');
																	$date_archive_link = get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'));
																	?>
																	<a href="<?php echo esc_url($date_archive_link); ?>" class="topppa-post-date"><?php echo esc_html(get_the_date($date_format)); ?></a>
																</li>
															<?php endif; ?>

															<?php if (in_array('author', $dpost_meta)) : ?>
																<li>
																	<?php
																	if (!empty($settings['author_icon']['value'])) {
																		\Elementor\Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
																	}
																	?>
																	<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="topppa-post-author"><?php the_author(); ?></a>
																</li>
															<?php endif; ?>

															<?php if ($settings['topppa_blog_styles'] !== 'style_two' && in_array('fcategory', $dpost_meta)) : ?>
																<li>
																	<?php
																	if (!empty($settings['cat_icon']['value'])) {
																		\Elementor\Icons_Manager::render_icon($settings['cat_icon'], ['aria-hidden' => 'true']);
																	}
																	?>
																	<?php
																	$categories = get_the_category();
																	if (!empty($categories)) {
																		$category_link = get_category_link($categories[0]->term_id); // Get the category archive link
																		echo '<a href="' . esc_url($category_link) . '" class="topppa-post-cat">' . esc_html($categories[0]->name) . '</a>';
																	}
																	?>
																</li>
															<?php endif; ?>

															<?php if (in_array('comment', $dpost_meta)) : ?>
																<li>
																	<?php
																	if (!empty($settings['comment_icon']['value'])) {
																		\Elementor\Icons_Manager::render_icon($settings['comment_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
																	}
																	?>
																	<?php echo esc_html(get_comments_number()); ?> <?php esc_html_e('Comments', 'topper-pack'); ?>
																</li>
															<?php endif; ?>
															<?php if (in_array('reading_time', $dpost_meta)) : ?>
																<li>
																	<?php if (!empty($settings['reading_time_icon']['value'])) {
																		\Elementor\Icons_Manager::render_icon($settings['reading_time_icon'], ['aria-hidden' => 'true']);
																	} ?>
																	<?php echo $this->topper_pack_estimated_reading_time(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																	?>
																</li>
															<?php endif; ?>
														</ul>
													<?php endif; ?>
												</div>
											<?php endif; ?>
											<!-- END POST META -->

											<<?php echo esc_attr($settings['title_tag']); ?> class="topppa-post-title">
												<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post(wp_trim_words(get_the_title(), $settings['title_length'], '')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																					?></a>
											</<?php echo esc_attr($settings['title_tag']); ?>>

											<?php if ($settings['enable_post_desc'] === 'yes') : ?>
												<div class="topppa-post-desc">
													<?php
													$description_length = isset($settings['dec_length']) && is_numeric($settings['dec_length']) ? (int) $settings['dec_length'] : 20;
													echo wp_trim_words(get_the_content(), $description_length, ''); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
													?>
												</div>
											<?php endif; ?>

											<?php if ($settings['enable_post_btn'] === 'yes') : ?>
												<?php if (!empty($settings['enable_post_btn']) && $settings['enable_post_btn'] === 'yes') : ?>

													<div class="topppa-btn-wrapper <?php echo esc_attr($btn_class); ?>">
														<a href="<?php the_permalink(); ?>"
															class="topppa-btn">
															<span class="top-btn-text top-btn-text-v3"><?php echo esc_html($settings['btn_text']) ?></span>
															<?php if ($btn_class === 'style-three') : ?>
																<span class="bottom-btn-text bottom-btn-text-v3"><?php echo esc_html($settings['btn_text']) ?></span>
															<?php endif; ?>
															<?php if (!empty($settings['show_btn_icon']) && $settings['show_btn_icon'] === 'yes') : ?>
																<div class="btn-icon">
																	<?php if (!empty($settings['btn_icon'])) : ?>
																		<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); ?>
																	<?php endif; ?>
																</div>
															<?php endif; ?>
														</a>

													</div>
												<?php endif; ?>
											<?php endif; ?>
										</div>
										<!-- START POST CONTENT FOR STYLE SEVEN -->
									<?php endif; ?>
								</div>

								<?php if ($settings['topppa_blog_styles'] !== 'style_seven' && $settings['topppa_blog_styles'] !== 'style_eight') : ?>
									<div class="topppa-post-content-wrap">
										<!-- START POST META -->
										<?php if ($settings['topppa_blog_styles'] !== 'style_three') : ?>
											<div class="post-meta">
												<?php if (!empty($settings['enable_meta']) && $settings['enable_meta'] === 'yes') : ?>
													<?php
													$dpost_meta = !empty($settings['post_meta']) && is_array($settings['post_meta'])
														? $settings['post_meta']
														: ['date', 'author', 'fcategory', 'comment', 'category', 'reading_time'];
													?>
													<ul>
														<?php if (in_array('date', $dpost_meta) && $settings['topppa_blog_styles'] !== 'style_three') : ?>
															<li>
																<?php
																if (!empty($settings['date_icon']['value'])) {
																	\Elementor\Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']);
																}
																?>
																<?php
																$date_format = $settings['date_format'] ?? 'F j, Y';
																$post_date = get_the_date('Y-m-d');
																$date_archive_link = get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'));
																?>
																<a href="<?php echo esc_url($date_archive_link); ?>" class="topppa-post-date"><?php echo esc_html(get_the_date($date_format)); ?></a>
															</li>
														<?php endif; ?>

														<?php if (in_array('author', $dpost_meta)) : ?>
															<li>
																<?php
																if (!empty($settings['author_icon']['value'])) {
																	\Elementor\Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']);
																}
																?>
																<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="topppa-post-author"><?php the_author(); ?></a>
															</li>
														<?php endif; ?>


														<?php if ($settings['topppa_blog_styles'] !== 'style_two' && in_array('fcategory', $dpost_meta)) : ?>
															<li>
																<?php
																if (!empty($settings['cat_icon']['value'])) {
																	\Elementor\Icons_Manager::render_icon($settings['cat_icon'], ['aria-hidden' => 'true']);
																}
																?>
																<?php
																$categories = get_the_category();
																if (!empty($categories)) {
																	$category_link = get_category_link($categories[0]->term_id); // Get the category archive link
																	echo '<a href="' . esc_url($category_link) . '" class="topppa-post-cat">' . esc_html($categories[0]->name) . '</a>';
																}
																?>
															</li>
														<?php endif; ?>

														<?php if (in_array('comment', $dpost_meta)) : ?>
															<li>
																<?php if (!empty($settings['comment_icon']['value'])) {
																	\Elementor\Icons_Manager::render_icon($settings['comment_icon'], ['aria-hidden' => 'true']);
																} ?>
																<?php echo esc_html(get_comments_number()); ?> <?php esc_html_e('Comments', 'topper-pack'); ?>
															</li>
														<?php endif; ?>
														<?php if (in_array('reading_time', $dpost_meta)) : ?>
															<li>
																<?php if (!empty($settings['reading_time_icon']['value'])) {
																	\Elementor\Icons_Manager::render_icon($settings['reading_time_icon'], ['aria-hidden' => 'true']);
																} ?>
																<?php echo $this->topper_pack_estimated_reading_time(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																?>
															</li>
														<?php endif; ?>
													</ul>
												<?php endif; ?>
											</div>
										<?php endif; ?>
										<!-- END POST META -->

										<<?php echo esc_attr($settings['title_tag']); ?> class="topppa-post-title">
											<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post(wp_trim_words(get_the_title(), $settings['title_length'], '')); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																				?></a>
										</<?php echo esc_attr($settings['title_tag']); ?>>

										<?php if ($settings['enable_post_desc'] === 'yes') : ?>
											<div class="topppa-post-desc">
												<?php
												$description_length = isset($settings['dec_length']) && is_numeric($settings['dec_length']) ? (int) $settings['dec_length'] : 20;
												echo wp_trim_words(get_the_content(), $description_length, ''); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
												?>
											</div>
										<?php endif; ?>

										<?php if ($settings['enable_category'] === 'yes') : ?>
											<div class="topppa-post-category">
												<?php
												$categories = get_the_category();
												if (!empty($categories)) {
													foreach ($categories as $category) {
														$category_link = get_category_link($category->term_id);
														echo '<a href="' . esc_url($category_link) . '" class="topppa-post-cat-item">' . esc_html($category->name) . '</a>';
													}
												}
												?>
											</div>
										<?php endif; ?>
										<?php if ($settings['enable_post_btn'] === 'yes') : ?>
											<?php if (!empty($settings['enable_post_btn']) && $settings['enable_post_btn'] === 'yes') : ?>

												<div class="topppa-btn-wrapper topppa-blog-btn-wrapper <?php echo esc_attr($btn_class); ?>">
													<a href="<?php the_permalink(); ?>"
														class="topppa-btn">
														<span class="top-btn-text top-btn-text-v3"><?php echo esc_html($settings['btn_text']) ?></span>
														<?php if ($btn_class === 'style-three') : ?>
															<span class="bottom-btn-text bottom-btn-text-v3"><?php echo esc_html($settings['btn_text']) ?></span>
														<?php endif; ?>
														<?php if (!empty($settings['show_btn_icon']) && $settings['show_btn_icon'] === 'yes') : ?>
															<div class="btn-icon">
																<?php if (!empty($settings['btn_icon'])) : ?>
																	<?php \Elementor\Icons_Manager::render_icon($settings['btn_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor 
																	?>
																<?php endif; ?>
															</div>
														<?php endif; ?>
													</a>

													<!-- START POST META IN BUTTON -->
													<?php if ($settings['topppa_blog_styles'] === 'style_three') : ?>
														<div class="post-meta">
															<?php if (!empty($settings['enable_meta']) && $settings['enable_meta'] === 'yes') : ?>
																<?php
																$dpost_meta = !empty($settings['post_meta']) && is_array($settings['post_meta'])
																	? $settings['post_meta']
																	: ['date', 'author', 'fcategory', 'comment', 'category'];
																?>
																<ul>
																	<?php if (in_array('date', $dpost_meta)) : ?>
																		<li>
																			<?php
																			if (!empty($settings['date_icon']['value'])) {
																				\Elementor\Icons_Manager::render_icon($settings['date_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
																			}
																			?>
																			<?php
																			$date_format = $settings['date_format'] ?? 'F j, Y';
																			$post_date = get_the_date('Y-m-d');
																			$date_archive_link = get_day_link(get_the_date('Y'), get_the_date('m'), get_the_date('d'));
																			?>
																			<a href="<?php echo esc_url($date_archive_link); ?>" class="topppa-post-date"><?php echo esc_html(get_the_date($date_format)); ?></a>
																		</li>
																	<?php endif; ?>

																	<?php if (in_array('author', $dpost_meta)) : ?>
																		<li>
																			<?php
																			if (!empty($settings['author_icon']['value'])) {
																				\Elementor\Icons_Manager::render_icon($settings['author_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
																			}
																			?>
																			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="topppa-post-author"><?php the_author(); ?></a>
																		</li>
																	<?php endif; ?>

																	<?php if (in_array('fcategory', $dpost_meta)) : ?>
																		<li>
																			<?php
																			if (!empty($settings['cat_icon']['value'])) {
																				\Elementor\Icons_Manager::render_icon($settings['cat_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
																			}
																			?>
																			<?php
																			$categories = get_the_category();
																			if (!empty($categories)) {
																				$category_link = get_category_link($categories[0]->term_id); // Get the category archive link
																				echo '<a href="' . esc_url($category_link) . '" class="topppa-post-cat">' . esc_html($categories[0]->name) . '</a>';
																			}
																			?>
																		</li>
																	<?php endif; ?>

																	<?php if (in_array('comment', $dpost_meta)) : ?>
																		<li>
																			<?php
																			if (!empty($settings['comment_icon']['value'])) {
																				\Elementor\Icons_Manager::render_icon($settings['comment_icon'], ['aria-hidden' => 'true']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped by elementor
																			}
																			?>
																			<?php echo esc_html(get_comments_number()); ?> <?php esc_html_e('Comments', 'topper-pack'); ?>
																		</li>
																	<?php endif; ?>
																	<?php if (in_array('reading_time', $dpost_meta)) : ?>
																		<li>
																			<?php if (!empty($settings['reading_time_icon']['value'])) {
																				\Elementor\Icons_Manager::render_icon($settings['reading_time_icon'], ['aria-hidden' => 'true']);
																			} ?>
																			<?php echo $this->topper_pack_estimated_reading_time(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																			?>
																		</li>
																	<?php endif; ?>
																</ul>
															<?php endif; ?>
														</div>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>
<?php
	}
}
