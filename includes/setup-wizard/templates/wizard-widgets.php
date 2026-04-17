<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="topppa-inner-content">
    <h2 class="topppa-title-small"><?php esc_html_e('Choose which widgets you need', 'topper-pack'); ?></h2>
    <p class="topppa-description"><?php esc_html_e('You can enable/disable them anytime from the dashboard.', 'topper-pack'); ?></p>

    <div class="topppa-widget-actions">
        <span class="topppa-enable-all"><?php esc_html_e('Enable All', 'topper-pack'); ?></span>
        <span class="topppa-disable-all"><?php esc_html_e('Disable All', 'topper-pack'); ?></span>
    </div>

    <div class="topppa-widget-container">
        <?php
        $wizard = new TopperPack_Setup_Wizard();
        $widgets = $wizard->get_widgets_data();
        $widget_count = 0;
        $total_widgets = count($widgets);
        $initial_show = 12;
        
        foreach ($widgets as $widget_id => $widget): 
            $widget_count++;
            $is_hidden = ($widget_count > $initial_show) ? 'topppa-hidden-widget' : '';
        ?>
            <?php if ($widget['is_pro'] && !$widget['show_toggle']): ?>
                <a href="https://topperpack.com/pricing/" target="_blank" class="topppa-item-widget topppa-pro-item-link <?php echo esc_attr($is_hidden); ?>">
                    <div class="topppa-pro-badge"><?php esc_html_e('PRO', 'topper-pack'); ?></div>
                    <div class="topppa-widget-inner">
                        <div class="topppa-widget-title"><?php echo esc_html($widget['title']); ?></div>
                    </div>
                </a>
            <?php else: ?>
                <div class="topppa-item-widget <?php echo esc_attr($widget['is_pro'] ? 'topppa-pro-item' : ''); ?> <?php echo esc_attr($is_hidden); ?>">
                    <?php if ($widget['is_pro']): ?>
                        <div class="topppa-pro-badge"><?php esc_html_e('PRO', 'topper-pack'); ?></div>
                    <?php endif; ?>
                    <div class="topppa-widget-inner">
                        <div class="topppa-widget-title"><?php echo esc_html($widget['title']); ?></div>
                        <div class="topppa-toggle">
                            <input 
                                id="topppa-widget-<?php echo esc_attr($widget_id); ?>"
                                type="checkbox" 
                                value="<?php echo esc_attr($widget_id); ?>"
                                class="topppa-toggle__check topppa-widget-toggle"
                                data-widget="<?php echo esc_attr($widget_id); ?>"
                                <?php echo wp_kses_post($widget['is_active'] ? 'checked' : ''); ?>
                            >
                            <div class="topppa-toggle__track"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <?php if ($total_widgets > $initial_show): ?>
        <div class="topppa-read-more-container">
            <button type="button" class="topppa-read-more-btn" data-show="more">
                <?php esc_html_e('Show More Widgets', 'topper-pack'); ?>
            </button>
        </div>
    <?php endif; ?>

    <div class="topppa-wizard-navigation">
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&step=welcome')); ?>" class="topppa-back-button">
            <?php esc_html_e('← Back', 'topper-pack'); ?>
        </a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&step=features')); ?>" class="topppa-next-button" data-next="features">
            <?php esc_html_e('Next →', 'topper-pack'); ?>
        </a>
    </div>
</div> 