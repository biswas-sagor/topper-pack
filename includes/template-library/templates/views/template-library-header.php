<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$logo =  TEMPLATE_LOGO_SRC;
?>
<script type="text/template" id="topppa-TemplateLibrary_header-logo">
	<span class="topppaTemplateLibrary_logo-wrap">
		<img src="<?php echo esc_url( $logo ); ?>" alt="<?php esc_attr_e( 'Topper Pack Library', 'topper-pack' ); ?>" width="25">
	</span>
    <span class="topppaTemplateLibrary_logo-title">{{{ title }}}</span>
</script>

<script type="text/template" id="topppa-TemplateLibrary_header-back">
	<i class="eicon-arrow-left" aria-hidden="true"></i>
	<span><?php esc_html_e( 'Back to Library', 'topper-pack' ); ?></span>
</script>

<script type="text/template" id="topppa-TemplateLibrary_header-menu">
	<# _.each( tabs, function( args, tab ) { var activeClass = args.active ? 'elementor-active' : ''; #>
		<div class="elementor-component-tab elementor-template-library-menu-item {{activeClass}}" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="topppa-TemplateLibrary_header-menu-responsive">
	
</script>

<script type="text/template" id="topppa-TemplateLibrary_header-actions">
	<div id="topppaTemplateLibrary_header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Library', 'topper-pack' ); ?>"></i>
		<span class="elementor-screen-only"><?php esc_html_e( 'Sync Library', 'topper-pack' ); ?></span>
	</div>
</script>