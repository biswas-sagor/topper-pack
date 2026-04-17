<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Animated Slider Widget.
 *
 * Elementor widget that displays an animated slider with customizable slides.
 *
 * @since 1.0.0
 */
class TOPPPA_Animated_Slider_Widget extends Widget_Base {

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
        return 'topppa_animated_slider';
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
        return esc_html__('Animated Slider', 'topper-pack');
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
        return 'eicon-slider-album';
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
        return ['topppa', 'widget', 'slider', 'animated', 'carousel', 'topperpack'];
    }

    /**
     * Register widget scripts.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget scripts.
     */
    public function get_script_depends() {
        return ['swiper', 'gsap', 'toppa-animated-slider'];
    }

    /**
     * Register widget styles.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget styles.
     */
    public function get_style_depends() {
        return ['swiper', 'toppa-animated-slider'];
    }

    /**
     * Register widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slider Content', 'topper-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Repeater for Slides
        $repeater = new Repeater();

        $repeater->add_control(
            'slide_image',
            [
                'label' => __('Slide Image', 'topper-pack'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'hero_overlay_bg',
            [
                'label' => __('Background Image', 'topper-pack'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hero_overlay_background',
                'label' => __('Background', 'topper-pack'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .hero-overlay',
            ]
        );

        $repeater->add_control(
            'slide_subtitle',
            [
                'label' => __('Subtitle', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Welcome to Luxury Living', 'topper-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_title',
            [
                'label' => __('Title', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Experience Modern Comfort', 'topper-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_description',
            [
                'label' => __('Description', 'topper-pack'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Step into a new standard of elegance and convenience with our premium apartments.', 'topper-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'button_1_text',
            [
                'label' => __('Button 1 Text', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Learn More', 'topper-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'button_1_url',
            [
                'label' => __('Button 1 URL', 'topper-pack'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'show_external' => true,
            ]
        );

        $repeater->add_control(
            'button_2_text',
            [
                'label' => __('Button 2 Text', 'topper-pack'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Get Started', 'topper-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'button_2_url',
            [
                'label' => __('Button 2 URL', 'topper-pack'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'show_external' => true,
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => __('Slides', 'topper-pack'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_subtitle' => __('Welcome to Luxury Living', 'topper-pack'),
                        'slide_title' => __('Experience Modern Comfort', 'topper-pack'),
                        'slide_description' => __('Step into a new standard of elegance and convenience with our premium apartments.', 'topper-pack'),
                        'button_1_text' => __('Learn More', 'topper-pack'),
                        'button_1_url' => ['url' => '#'],
                        'button_2_text' => __('Get Started', 'topper-pack'),
                        'button_2_url' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        // Button Icon Control
        $this->add_control(
            'button_icon',
            [
                'label' => __('Button Icon', 'topper-pack'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-arrow-right',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();

        // Slider Settings Section
        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => __('Slider Settings', 'topper-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop Slides', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'min' => 1000,
                'max' => 10000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'slide_speed',
            [
                'label' => __('Slide Transition Speed (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 100,
                'max' => 2000,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => __('Transition Effect', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade',
                'options' => [
                    'slide' => __('Slide', 'topper-pack'),
                    'fade' => __('Fade', 'topper-pack'),
                    'cube' => __('Cube', 'topper-pack'),
                    'coverflow' => __('Coverflow', 'topper-pack'),
                    'flip' => __('Flip', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => __('Show Navigation Arrows', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => __('Show Pagination Dots', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_counter',
            [
                'label' => __('Show Slide Counter', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ken_burns_effect',
            [
                'label' => __('Enable Ken Burns Effect', 'topper-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'topper-pack'),
                'label_off' => __('No', 'topper-pack'),
                'default' => 'yes',
                'description' => __('Enable or disable the Ken Burns effect (zooming and panning) on slide background images.', 'topper-pack'),
            ]
        );

        $this->end_controls_section();

        // Animation Controls
        $this->start_controls_section(
            'animation_section',
            [
                'label' => __('Animation Settings', 'topper-pack'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label' => __('Global Animation Type', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide-left',
                'options' => [
                    'slide-left' => __('Slide Left', 'topper-pack'),
                    'slide-right' => __('Slide Right', 'topper-pack'),
                    'slide-up' => __('Slide Up', 'topper-pack'),
                    'slide-down' => __('Slide Down', 'topper-pack'),
                    'fade' => __('Fade', 'topper-pack'),
                    'scale-up' => __('Scale Up', 'topper-pack'),
                    'scale-down' => __('Scale Down', 'topper-pack'),
                    'rotate' => __('Rotate', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'animation_delay',
            [
                'label' => __('Animation Delay (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 50,
                'min' => 0,
                'max' => 1000,
            ]
        );

        $this->add_control(
            'animation_duration',
            [
                'label' => __('Animation Duration (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 100,
                'max' => 2000,
            ]
        );

        $this->add_control(
            'subtitle_animation_type',
            [
                'label' => __('Subtitle Animation', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'chars',
                'options' => [
                    'chars' => __('By Characters', 'topper-pack'),
                    'words' => __('By Words', 'topper-pack'),
                    'lines' => __('By Lines', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'title_animation_type',
            [
                'label' => __('Title Animation', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'words',
                'options' => [
                    'chars' => __('By Characters', 'topper-pack'),
                    'words' => __('By Words', 'topper-pack'),
                    'lines' => __('By Lines', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'desc_animation_type',
            [
                'label' => __('Description Animation', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'words',
                'options' => [
                    'chars' => __('By Characters', 'topper-pack'),
                    'words' => __('By Words', 'topper-pack'),
                    'lines' => __('By Lines', 'topper-pack'),
                ],
            ]
        );

        // Button Animation Controls
        $this->add_control(
            'button_animation_type',
            [
                'label' => __('Button Animation Type', 'topper-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide-up',
                'options' => [
                    'slide-left' => __('Slide Left', 'topper-pack'),
                    'slide-right' => __('Slide Right', 'topper-pack'),
                    'slide-up' => __('Slide Up', 'topper-pack'),
                    'slide-down' => __('Slide Down', 'topper-pack'),
                    'fade' => __('Fade', 'topper-pack'),
                    'scale-up' => __('Scale Up', 'topper-pack'),
                    'scale-down' => __('Scale Down', 'topper-pack'),
                    'rotate' => __('Rotate', 'topper-pack'),
                ],
            ]
        );

        $this->add_control(
            'button_animation_delay',
            [
                'label' => __('Button Animation Delay (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 0,
                'max' => 2000,
                'description' => __('Delay before button animation starts after slide change', 'topper-pack'),
            ]
        );

        $this->add_control(
            'button_animation_duration',
            [
                'label' => __('Button Animation Duration (ms)', 'topper-pack'),
                'type' => Controls_Manager::NUMBER,
                'default' => 600,
                'min' => 100,
                'max' => 2000,
                'description' => __('How long the button animation takes to complete', 'topper-pack'),
            ]
        );

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

        // Animation Settings
        $animation_type = $settings['animation_type'] ?? 'slide-left';
        $animation_delay = intval($settings['animation_delay'] ?? 50);
        $animation_duration = intval($settings['animation_duration'] ?? 600);

        // Text Animation Types
        $subtitle_anim_type = $settings['subtitle_animation_type'] ?? 'chars';
        $title_anim_type = $settings['title_animation_type'] ?? 'words';
        $desc_anim_type = $settings['desc_animation_type'] ?? 'words';

        // Button Animation Settings
        $button_animation_type = $settings['button_animation_type'] ?? 'slide-up';
        $button_animation_delay = intval($settings['button_animation_delay'] ?? 600);
        $button_animation_duration = intval($settings['button_animation_duration'] ?? 600);

        // Slider Settings
        $loop = $settings['loop'] === 'yes' ? 'true' : 'false';
        $autoplay = $settings['autoplay'] === 'yes' ? 'true' : 'false';
        $autoplay_speed = intval($settings['autoplay_speed'] ?? 5000);
        $slide_speed = intval($settings['slide_speed'] ?? 600);
        $effect = $settings['effect'] ?? 'fade';
        $show_arrows = $settings['show_arrows'] === 'yes';
        $show_dots = $settings['show_dots'] === 'yes';
        $show_counter = $settings['show_counter'] === 'yes';
        $ken_burns_effect = $settings['ken_burns_effect'] === 'yes';
?>
        <div class="swiper mySwiper conwork-hero-slider"
            data-loop="<?php echo esc_attr($loop); ?>"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>"
            data-slide-speed="<?php echo esc_attr($slide_speed); ?>"
            data-effect="<?php echo esc_attr($effect); ?>">
            <div class="swiper-wrapper">
                <?php foreach ($settings['slides'] as $index => $slide) :
                    $bg_url = !empty($slide['hero_overlay_bg']['url']) ? esc_url($slide['hero_overlay_bg']['url']) : '';
                ?>
                    <div class="swiper-slide">
                        <img class="slide-bg <?php echo esc_attr($ken_burns_effect ? 'kenBurns' : ''); ?>"
                            src="<?php echo esc_url($slide['slide_image']['url']); ?>"
                            alt="<?php echo esc_attr($slide['slide_title']); ?>">
                        <div class="hero-overlay" style="background-image: url('<?php echo esc_url($bg_url); ?>');"></div>

                        <div class="container">
                            <div class="slide-content"
                                data-animation-type="<?php echo esc_attr($animation_type); ?>"
                                data-animation-delay="<?php echo esc_attr($animation_delay); ?>"
                                data-animation-duration="<?php echo esc_attr($animation_duration); ?>"
                                data-subtitle-animation-type="<?php echo esc_attr($subtitle_anim_type); ?>"
                                data-title-animation-type="<?php echo esc_attr($title_anim_type); ?>"
                                data-desc-animation-type="<?php echo esc_attr($desc_anim_type); ?>"
                                data-button-animation-type="<?php echo esc_attr($button_animation_type); ?>"
                                data-button-animation-delay="<?php echo esc_attr($button_animation_delay); ?>"
                                data-button-animation-duration="<?php echo esc_attr($button_animation_duration); ?>">
                                <?php if (!empty($slide['slide_subtitle'])) : ?>
                                    <div class="conwork-hero-subtitle"><?php echo esc_html($slide['slide_subtitle']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($slide['slide_title'])) : ?>
                                    <div class="conwork-hero-title"><?php echo esc_html($slide['slide_title']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($slide['slide_description'])) : ?>
                                    <div class="conwork-hero-description"><?php echo esc_html($slide['slide_description']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($slide['button_1_text']) || !empty($slide['button_2_text'])) : ?>
                                    <div class="conwork-hero-buttons">
                                        <?php if (!empty($slide['button_1_text'])) : ?>
                                            <a href="<?php echo esc_url($slide['button_1_url']['url']); ?>" class="conwork-button primary-button"
                                                <?php echo $slide['button_1_url']['is_external'] ? 'target="_blank"' : ''; ?>
                                                <?php echo $slide['button_1_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                                <?php echo esc_html($slide['button_1_text']); ?>
                                                <span class="conwork-button-icon">
                                                    <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!empty($slide['button_2_text'])) : ?>
                                            <a href="<?php echo esc_url($slide['button_2_url']['url']); ?>" class="conwork-button primary-button button-2"
                                                <?php echo $slide['button_2_url']['is_external'] ? 'target="_blank"' : ''; ?>
                                                <?php echo $slide['button_2_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                                <?php echo esc_html($slide['button_2_text']); ?>
                                                <span class="conwork-button-icon">
                                                    <?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($show_arrows) : ?>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            <?php endif; ?>
            <?php if ($show_dots) : ?>
                <div class="swiper-pagination"></div>
            <?php endif; ?>
            <?php if ($show_counter) : ?>
                <div class="swiper-counter"></div>
            <?php endif; ?>
        </div>
        <script>
            // =============================================
            // Hero Slider Functionality
            // =============================================
            function initHeroSlider($scope) {
                const swiperEl = $scope.find('.mySwiper')[0];
                if (!swiperEl) return;

                const animateSlideContent = (slide) => {
                    if (!slide) return;

                    const subtitleEl = slide.querySelector('.conwork-hero-subtitle');
                    const titleEl = slide.querySelector('.conwork-hero-title');
                    const descEl = slide.querySelector('.conwork-hero-description');
                    const buttonsEl = slide.querySelector('.conwork-hero-buttons');

                    const animType = slide.dataset.animationType || 'slide-left';
                    const animDelay = parseInt(slide.dataset.animationDelay) || 50;
                    const animDuration = parseInt(slide.dataset.animationDuration) || 600;

                    const subtitleAnimType = slide.dataset.subtitleAnimationType || 'chars';
                    const titleAnimType = slide.dataset.titleAnimationType || 'words';
                    const descAnimType = slide.dataset.descAnimationType || 'words';

                    const buttonAnimType = slide.dataset.buttonAnimationType || 'slide-up';
                    const buttonAnimDelay = parseInt(slide.dataset.buttonAnimationDelay) || 600;
                    const buttonAnimDuration = parseInt(slide.dataset.buttonAnimationDuration) || 600;

                    let splitSubtitle, splitTitle, splitDesc;

                    if (subtitleEl) splitSubtitle = new SplitText(subtitleEl, {
                        type: subtitleAnimType
                    });
                    if (titleEl) splitTitle = new SplitText(titleEl, {
                        type: titleAnimType
                    });
                    if (descEl) splitDesc = new SplitText(descEl, {
                        type: descAnimType
                    });

                    const subtitleElements = splitSubtitle ? (subtitleAnimType === 'chars' ? splitSubtitle.chars : splitSubtitle[subtitleAnimType]) : [];
                    const titleElements = splitTitle ? (titleAnimType === 'chars' ? splitTitle.chars : splitTitle[titleAnimType]) : [];
                    const descElements = splitDesc ? (descAnimType === 'chars' ? splitDesc.chars : splitDesc[descAnimType]) : [];

                    gsap.killTweensOf([...subtitleElements, ...titleElements, ...descElements, buttonsEl]);

                    let animConfig = {
                        x: 0,
                        y: 0,
                        opacity: 0
                    }; // default
                    switch (animType) {
                        case 'slide-left':
                            animConfig = {
                                x: -40,
                                opacity: 0
                            };
                            break;
                        case 'slide-right':
                            animConfig = {
                                x: 40,
                                opacity: 0
                            };
                            break;
                        case 'slide-up':
                            animConfig = {
                                y: 40,
                                opacity: 0
                            };
                            break;
                        case 'slide-down':
                            animConfig = {
                                y: -40,
                                opacity: 0
                            };
                            break;
                        case 'fade':
                            animConfig = {
                                opacity: 0
                            };
                            break;
                        case 'scale-up':
                            animConfig = {
                                scale: 0.5,
                                opacity: 0
                            };
                            break;
                        case 'scale-down':
                            animConfig = {
                                scale: 1.5,
                                opacity: 0
                            };
                            break;
                        case 'rotate':
                            animConfig = {
                                rotation: 180,
                                opacity: 0
                            };
                            break;
                    }

                    let buttonAnimConfig = {
                        x: 0,
                        y: 0,
                        opacity: 0
                    };
                    switch (buttonAnimType) {
                        case 'slide-left':
                            buttonAnimConfig = {
                                x: -40,
                                opacity: 0
                            };
                            break;
                        case 'slide-right':
                            buttonAnimConfig = {
                                x: 40,
                                opacity: 0
                            };
                            break;
                        case 'slide-up':
                            buttonAnimConfig = {
                                y: 40,
                                opacity: 0
                            };
                            break;
                        case 'slide-down':
                            buttonAnimConfig = {
                                y: -40,
                                opacity: 0
                            };
                            break;
                        case 'fade':
                            buttonAnimConfig = {
                                opacity: 0
                            };
                            break;
                        case 'scale-up':
                            buttonAnimConfig = {
                                scale: 0.5,
                                opacity: 0
                            };
                            break;
                        case 'scale-down':
                            buttonAnimConfig = {
                                scale: 1.5,
                                opacity: 0
                            };
                            break;
                        case 'rotate':
                            buttonAnimConfig = {
                                rotation: 180,
                                opacity: 0
                            };
                            break;
                    }

                    if (subtitleElements.length) gsap.from(subtitleElements, {
                        ...animConfig,
                        stagger: animDelay / 1000,
                        duration: animDuration / 1000,
                        ease: 'power3.out'
                    });
                    if (titleElements.length) gsap.from(titleElements, {
                        ...animConfig,
                        stagger: animDelay / 1000,
                        duration: animDuration / 1000,
                        ease: 'power3.out',
                        delay: animDuration / 2000
                    });
                    if (descElements.length) gsap.from(descElements, {
                        ...animConfig,
                        stagger: animDelay / 1000,
                        duration: animDuration / 1000,
                        ease: 'power3.out',
                        delay: animDuration / 1500
                    });

                    if (buttonsEl) {
                        gsap.set(buttonsEl, buttonAnimConfig);
                        gsap.to(buttonsEl, {
                            x: 0,
                            y: 0,
                            scale: 1,
                            rotation: 0,
                            opacity: 1,
                            duration: buttonAnimDuration / 1000,
                            ease: 'power3.out',
                            delay: buttonAnimDelay / 1000
                        });
                    }
                };

                const loop = swiperEl.dataset.loop === 'true';
                const autoplay = swiperEl.dataset.autoplay === 'true';
                const autoplaySpeed = parseInt(swiperEl.dataset.autoplaySpeed) || 5000;
                const slideSpeed = parseInt(swiperEl.dataset.slideSpeed) || 600;
                const effect = swiperEl.dataset.effect || 'fade';

                const swiperConfig = {
                    loop: loop,
                    speed: slideSpeed,
                    effect: effect,
                    ...(effect === 'fade' && {
                        fadeEffect: {
                            crossFade: true
                        }
                    }),
                    ...(autoplay && {
                        autoplay: {
                            delay: autoplaySpeed,
                            disableOnInteraction: false
                        }
                    }),
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev'
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    on: {
                        init: function() {
                            const firstSlide = this.slides[this.activeIndex].querySelector('.slide-content');
                            animateSlideContent(firstSlide);
                            updateCounter(this);
                        },
                        slideChangeTransitionStart: function() {
                            const currentSlide = this.slides[this.activeIndex].querySelector('.slide-content');
                            animateSlideContent(currentSlide);
                            updateCounter(this);
                        }
                    }
                };

                function updateCounter(swiperInstance) {
                    const counterEl = swiperEl.querySelector('.swiper-counter');
                    if (!counterEl) return;

                    const totalSlides = loop ? swiperInstance.slides.length - (swiperInstance.loopedSlides * 2) : swiperInstance.slides.length;

                    const formatNumber = (num) => (num < 10 ? '0' + num : num);
                    let buttonsHTML = '';
                    for (let i = 1; i <= totalSlides; i++) {
                        buttonsHTML += `<span class="counter-btn ${i === swiperInstance.realIndex + 1 ? 'active' : ''}" data-slide="${i}">${formatNumber(i)}</span>`;
                    }
                    counterEl.innerHTML = buttonsHTML;

                    counterEl.querySelectorAll('.counter-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            swiperInstance.slideToLoop(parseInt(this.dataset.slide) - 1);
                        });
                    });
                }

                new Swiper(swiperEl, swiperConfig);
            }
        </script>
<?php
    }
}

Plugin::instance()->widgets_manager->register(new TOPPPA_Animated_Slider_Widget());
