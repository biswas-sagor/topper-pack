<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script type="text/template" id="topppa-TemplateLibrary_template">
	<div class="topppa-TemplateLibrary_template-body" id="topppa-template-{{ template_id }}">
		<div class="topppa-TemplateLibrary_template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="topppa-TemplateLibrary_template-thumbnail" src="{{ thumbnail }}">
		<div class="topppa-TemplateLibrary_template-name">{{{ title }}}</div>
	</div>
	<div class="topppa-TemplateLibrary_template-footer">
		{{{ topppa.library.getModal().getTemplateActionButton( obj ) }}}
	</div>
</script>