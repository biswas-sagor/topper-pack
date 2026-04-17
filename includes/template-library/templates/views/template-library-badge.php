<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script type="text/template" id="topppa_TemplateLibrary_templates">
	<div id="topppaTemplateLibrary_toolbar">
		<div id="topppaTemplateLibrary_toolbar-search">
			<label for="topppaTemplateLibrary_search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'topper-pack' ); ?></label>
			<input id="topppaTemplateLibrary_search" placeholder="<?php esc_attr_e( 'Search', 'topper-pack' ); ?>">
			<i class="eicon-search"></i>
		</div>
		<div id="topppaTemplateLibrary_toolbar-counter"></div>
		
		<div id="topppaTemplateLibrary_toolbar-filter" class="topppaTemplateLibrary_toolbar-filter">
			<# if (topppa.library.getTypeTags()) { var selectedTag = topppa.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="topppaTemplateLibrary_filter-btn">{{{ topppa.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="topppaTemplateLibrary_filter-btn"><?php esc_html_e( 'Filter', 'topper-pack' ); ?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="topppaTemplateLibrary_filter-tags" class="topppaTemplateLibrary_filter-tags">
					<li data-tag="">All</li>
					<# _.each(topppa.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ topppa.library.getTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
	</div>

	<div class="topppa-TemplateLibrary_templates-window">
		<div id="topppa-TemplateLibrary_templates-list"></div>
	</div>
</script>