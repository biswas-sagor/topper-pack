<?php 
/**
 * Global Component Trait
 *
 * @package TopperPack
 */
namespace TopperPack\Traits;

use TopperPack\Includes\Utilities;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

defined('ABSPATH') || exit();

/*
* Global Component Trait
*/
trait Global_Component {
    
    public function topppa_get_global_button_effects_controls( $condition = [] ) {
        $this->add_control(
			'topppa_btn_styles',
			[
				'label' => esc_html__('Button Styles', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_one',
				'options' => [
					'style_one' => esc_html__('Style One', 'topper-pack'),
					'style_two' => esc_html__('Style Two', 'topper-pack'),
					'pro_three' => esc_html__('Style Three(Pro)', 'topper-pack'),
					'style_four' => esc_html__('Style Four', 'topper-pack'),
					'pro_five' => esc_html__('Style Five(Pro)', 'topper-pack'),
					'style_six' => esc_html__('Style Six', 'topper-pack'),
					'style_seven' => esc_html__('Style Seven', 'topper-pack'),
					'pro_eight' => esc_html__('Style Eight(Pro)', 'topper-pack'),
					'style_nine' => esc_html__('Style Nine', 'topper-pack'),
					'pro_ten' => esc_html__('Style Ten(Pro)', 'topper-pack'),
					'style_eleven' => esc_html__('Style Eleven', 'topper-pack'),
					'style_twelve' => esc_html__('Style Twelve', 'topper-pack'),
					'Pro_13' => esc_html__('Style Thirteen(Pro)', 'topper-pack'),
					'pro_14' => esc_html__('Style Fourteen(Pro)', 'topper-pack'),
					'style_fifteen' => esc_html__('Style Fifteen', 'topper-pack'),
				],
                'condition' => $condition,
			]
		);
        
        // Add upgrade notice for Pro button styles
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
            'button', 
            'topppa_btn_styles', 
            ['pro_three', 'pro_five', 'pro_eight', 'pro_ten', 'Pro_13', 'pro_14']
        );
    }

    public function topppa_global_title_tag( $condition = [] ) {
        $this->add_control(
			'title_tag',
			[
				'label' => esc_html__('HTML Tag', 'topper-pack'),
				'description' => esc_html__('Add HTML Tag For Small Title', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => [
					'h1'  => esc_html__('H1', 'topper-pack'),
					'h2'  => esc_html__('H2', 'topper-pack'),
					'h3'  => esc_html__('H3', 'topper-pack'),
					'pro_4'  => esc_html__('H4(Pro)', 'topper-pack'),
					'pro_5'  => esc_html__('H5(Pro)', 'topper-pack'),
					'pro_6'  => esc_html__('H6(Pro)', 'topper-pack'),
					'pro_7'  => esc_html__('P(Pro)', 'topper-pack'),
					'pro_8'  => esc_html__('span(Pro)', 'topper-pack'),
					'pro_9'  => esc_html__('Div(Pro)', 'topper-pack'),
				],
				'condition' => $condition,
			]
		);

		Utilities::upgrade_pro_notice( 
			$this, 
			\Elementor\Controls_Manager::RAW_HTML, 
			'title_tag', 
			'title_tag', ['pro_4', 'pro_5', 'pro_6', 'pro_7', 'pro_8', 'pro_9']
		);
    }

	public function topppa_global_image_animation( $condition = [] ) {
		$this->add_control(
			'post_img_anim',
			[
				'label' => esc_html__('Image Animation', 'topper-pack'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'anim_one',
				'options' => [
					'none' => esc_html__('None', 'topper-pack'),
					'anim_one' => esc_html__('Anim One', 'topper-pack'),
					'pro_anim_two'  => esc_html__('Anim Two (Pro)', 'topper-pack'),
					'pro_anim_three'  => esc_html__('Anim Three (Pro)', 'topper-pack'),
					'pro_anim_rotate'  => esc_html__('Anim Rotate (Pro)', 'topper-pack'),
				],
				'condition' => $condition,
			]
		);
		// Add upgrade notice for Pro image animation
        Utilities::upgrade_pro_notice( 
            $this, 
            \Elementor\Controls_Manager::RAW_HTML, 
			'post_img_anim',
			'post_img_anim',
            ['pro_anim_two', 'pro_anim_three', 'pro_anim_rotate']
        );
	}
}