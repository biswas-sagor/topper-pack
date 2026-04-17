<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="topppa-inner-content">
    <h2 class="topppa-title-big">🎉 <?php esc_html_e('Congratulations!', 'topper-pack'); ?></h2>
    <p class="topppa-description"><?php esc_html_e('You have completed your setup for Topper Pack', 'topper-pack'); ?></p>
    <p class="topppa-description"><?php esc_html_e('Add more creativity to your design with Topper Pack 😃', 'topper-pack'); ?></p>
    <div class="topppa-quick-links">
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack')); ?>"><?php esc_html_e('Go to Dashboard', 'topper-pack'); ?></a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-widgets')); ?>"><?php esc_html_e('Manage Widgets', 'topper-pack'); ?></a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-extensions')); ?>"><?php esc_html_e('Manage Extensions', 'topper-pack'); ?></a>
        <a href="https://doc.topperpack.com/" target="_blank"><?php esc_html_e('View Documentation', 'topper-pack'); ?></a>
    </div>
    <div class="topppa-wizard-navigation">
        <a href="<?php echo esc_url(admin_url('admin.php?page=topper-pack-wizard&step=bepro')); ?>" class="topppa-back-button">
            <?php esc_html_e('← Back', 'topper-pack'); ?>
        </a>
        <button class="topppa-next-button topppa-complete-wizard">
            <?php esc_html_e('Complete Setup →', 'topper-pack'); ?>
        </button>
    </div>
</div> 