(function ($) {
	"use strict";

	function topppa_hf_hide_meta_fields () {
		var selected = $( '#topppa_hf_template_type' ).val() || 'none';
		$( '.topppa-hf__meta-options-table' ).removeClass().addClass( 'topppa-hf__meta-options-table widefat topppa-hf-selected-template-type-' + selected );
	};

	$(document).on('change', '#topppa_hf_template_type', () => topppa_hf_hide_meta_fields() );

	topppa_hf_hide_meta_fields();

	let selectElement = $('select[name="topppa-hf-include-locations[rule][0]"]');
	let option = selectElement.find('option[value="basic-global"]');

	let templateType = $('#topppa_hf_template_type').val();
	if ( templateType != 'header' && templateType != 'footer' && templateType != 'page-title') {
		option.remove();
	}

	$('#topppa_hf_template_type').on('change', function () {
		let selectElement = $('select[name="topppa-hf-include-locations[rule][0]"]');
		let option = selectElement.find('option[value="basic-global"]');
		let basicOptgroup = selectElement.find('optgroup[label="Basic"]');
		if ($(this).val() != 'header' && $(this).val() != 'footer' && $(this).val() != 'page-title') {
			option.remove();
		} else {
			// Check if the option is not present and add it inside the "Basic" optgroup
			if (option.length === 0) {
				basicOptgroup.prepend('<option value="basic-global">Entire Website</option>');
			}
		}
	});

})(jQuery);
