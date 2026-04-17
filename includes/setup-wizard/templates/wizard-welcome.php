<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="topppa-inner-content">
    <div class="topppa-welcome-content">
        <h1 class="topppa-title-big"><?php esc_html_e('Welcome to Topper Pack!', 'topper-pack'); ?></h1>
        <div class="topppa-server-info">
            <h3><?php esc_html_e('Server Information', 'topper-pack'); ?></h3>
            <div class="topppa-info-grid">
                <div class="topppa-info-item">
                    <span class="topppa-label"><?php esc_html_e('PHP Memory Limit:', 'topper-pack'); ?></span>
                    <span class="topppa-value"><?php echo esc_html(ini_get('memory_limit')); ?></span>
                </div>
                <div class="topppa-info-item">
                    <span class="topppa-label"><?php esc_html_e('PHP Version:', 'topper-pack'); ?></span>
                    <span class="topppa-value"><?php echo esc_html(PHP_VERSION); ?></span>
                </div>
                <div class="topppa-info-item">
                    <span class="topppa-label"><?php esc_html_e('WordPress Version:', 'topper-pack'); ?></span>
                    <span class="topppa-value"><?php echo esc_html(get_bloginfo('version')); ?></span>
                </div>
                <div class="topppa-info-item">
                    <span class="topppa-label"><?php esc_html_e('Max Upload Size:', 'topper-pack'); ?></span>
                    <span class="topppa-value"><?php echo esc_html(size_format(wp_max_upload_size())); ?></span>
                </div>
                <div class="topppa-info-item">
                    <span class="topppa-label"><?php esc_html_e('Max Post Size:', 'topper-pack'); ?></span>
                    <span class="topppa-value"><?php echo esc_html(ini_get('post_max_size')); ?></span>
                </div>
                <div class="topppa-info-item">
                    <span class="topppa-label"><?php esc_html_e('Max Execution Time:', 'topper-pack'); ?></span>
                    <span class="topppa-value"><?php echo esc_html(ini_get('max_execution_time')); ?>s</span>
                </div>
            </div>
        </div>
        
        <div class="topppa-video-section">
            <h3><?php esc_html_e('Getting Started with Topper Pack', 'topper-pack'); ?></h3>
            <div class="topppa-video-container">
                <iframe 
                    width="100%" 
                    height="315" 
                    src="https://www.youtube.com/embed/1L3-Li9brMM?si=djvD5NXXtatW37FM" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
            <p class="topppa-video-description">
                <?php esc_html_e('Watch this quick overview to learn how to get the most out of Topper Pack and configure your widgets and features.', 'topper-pack'); ?>
            </p>
        </div>
        
        <div class="topppa-wizard-navigation">
            <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&step=widgets')); ?>" class="topppa-next-button" data-next="widgets">
                <?php esc_html_e('Start Setup →', 'topper-pack'); ?>
            </a>
        </div>
    </div>
    
    <div class="topppa-skip-setup">
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&action=skip&nonce=' . wp_create_nonce('skip_wizard'))); ?>" class="topppa-skip-link">
            <?php esc_html_e('Skip Setup & Go to Dashboard', 'topper-pack'); ?>
        </a>
    </div>
</div> 