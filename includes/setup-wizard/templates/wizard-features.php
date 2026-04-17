<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="topppa-inner-content">
    <h2 class="topppa-title-small"><?php esc_html_e('Choose the features you need right now!', 'topper-pack'); ?></h2>
    <p class="topppa-description"><?php esc_html_e('You can always enable/disable any features later from the dashboard.', 'topper-pack'); ?></p>

    <div class="topppa-description" style="background: var(--topppa-border); padding: 10px; border-radius: 8px; margin: 10px 0; text-align: center;">
        <?php esc_html_e('We all love having as many features as possible. But it might impact Elementor editor loading time. So we suggest you to disable the unused features to keep everything super optimized.', 'topper-pack'); ?>
    </div>

    <div class="topppa-feature-container">
        <?php
        $wizard = new TopperPack_Setup_Wizard();
        $features = $wizard->get_features_data();
        
        foreach ($features as $extension_id => $feature): ?>
            <?php if ($feature['is_pro'] && !$feature['show_toggle']): ?>
                <a href="https://topperpack.com/pricing/" target="_blank" class="topppa-item-feature topppa-pro-item-link">
                    <div class="topppa-pro-badge"><?php esc_html_e('PRO', 'topper-pack'); ?></div>
                    <div class="topppa-feature-inner">
                        <div class="topppa-feature-title"><?php echo esc_html($feature['title']); ?></div>
                    </div>
                </a>
            <?php else: ?>
                <div class="topppa-item-feature <?php echo $feature['is_pro'] ? 'topppa-pro-item' : ''; ?>">
                    <?php if ($feature['is_pro']): ?>
                        <div class="topppa-pro-badge"><?php esc_html_e('PRO', 'topper-pack'); ?></div>
                    <?php endif; ?>
                    <div class="topppa-feature-inner">
                        <div class="topppa-feature-title"><?php echo esc_html($feature['title']); ?></div>
                        <div class="topppa-toggle">
                            <input 
                                id="topppa-feature-<?php echo esc_attr($extension_id); ?>"
                                type="checkbox" 
                                value="<?php echo esc_attr($extension_id); ?>"
                                class="topppa-toggle__check topppa-feature-toggle"
                                data-extension="<?php echo esc_attr($extension_id); ?>"
                                <?php echo $feature['is_active'] ? 'checked' : ''; ?>
                            >
                            <div class="topppa-toggle__track"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="topppa-wizard-navigation">
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&step=widgets')); ?>" class="topppa-back-button">
            <?php esc_html_e('← Back', 'topper-pack'); ?>
        </a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&step=bepro')); ?>" class="topppa-next-button" data-next="bepro">
            <?php esc_html_e('Next →', 'topper-pack'); ?>
        </a>
    </div>
</div> 