(function ( $ ) {

	var user_role_update_close_button = function(wrapper) {

		type 		= wrapper.closest('.topppa-hf__user-role-wrapper').attr('data-type');
		rules 		= wrapper.find('.topppa-hf__user-role-condition');
		show_close	= false;

		if ( rules.length > 1 ) {
			show_close = true;
		}
		
		rules.each(function() {
			if ( show_close ) {
				jQuery(this).find('.topppa-hf__user-role-condition-delete').removeClass('topppa-hf__element-hidden');
			}else{
				jQuery(this).find('.topppa-hf__user-role-condition-delete').addClass('topppa-hf__element-hidden');
			}
		});
	};

	$(document).ready(function($) {

		jQuery('.topppa-hf__user-role-selector-wrapper').each(function() {
			user_role_update_close_button( jQuery(this) );
		})
		
		jQuery( '.topppa-hf__user-role-selector-wrapper' ).on( 'click', '.topppa-hf__user-add-role-condition-wrapper a', function(e) {
			e.preventDefault();
			e.stopPropagation();
			var $this 		= jQuery( this ),
				id 			= $this.attr( 'data-rule-id' ),
				new_id 		= parseInt(id) + 1,
				rule_wrap 	= $this.closest('.topppa-hf__user-role-selector-wrapper').find('.topppa-hf__user-role-builder-wrapper'),
				template  	= wp.template( 'topppa-hf-user-role-condition' ),
				field_wrap 	= $this.closest('.topppa-hf__user-role-wrapper');

			rule_wrap.append( template( { id : new_id } ) );
			
			$this.attr( 'data-rule-id', new_id );

			user_role_update_close_button( field_wrap );
		});

		jQuery( '.topppa-hf__user-role-selector-wrapper' ).on( 'click', '.topppa-hf__user-role-condition-delete', function(e) {
			var $this 			= jQuery( this ),
				rule_condition 	= $this.closest('.topppa-hf__user-role-condition'),
				field_wrap 		= $this.closest('.topppa-hf__user-role-wrapper');
				cnt 			= 0,
				data_type 		= field_wrap.attr( 'data-type' ),
				optionVal 		= $this.siblings('.topppa-hf__user-role-condition-wrapper').children('.topppa-hf__user-role-condition-input').val();

			rule_condition.remove();

			field_wrap.find('.topppa-hf__user-role-condition').each(function(i) {
				var condition       = jQuery( this ),
					old_rule_id     = condition.attr('data-rule'),
					select_location = condition.find('.topppa-hf__user-role-condition-input'),
					location_name   = select_location.attr( 'name' );
					
				condition.attr( 'data-rule', i );

				select_location.attr( 'name', location_name.replace('['+old_rule_id+']', '['+i+']') );

				condition.removeClass('topppa-hf__user-role-'+old_rule_id).addClass('topppa-hf__user-role-'+i);

				cnt = i;
			});

			field_wrap.find('.topppa-hf__user-add-role-condition-wrapper a').attr( 'data-rule-id', cnt )

			user_role_update_close_button( field_wrap );
		});
	});
}(jQuery, window));