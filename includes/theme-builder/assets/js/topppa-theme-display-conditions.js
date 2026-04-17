(function ( $ ) {

	var init_display_conditions  = function( selector ) {
		
		$(selector).select2({

			placeholder: topppa_display_conditions.search,

			ajax: {
			    url: ajaxurl,
			    dataType: 'json',
			    method: 'post',
			    delay: 250,
			    data: function (params) {
			      	return {
			        	q: params.term, // search term
				        page: params.page,
						action: 'topppa_hfe_get_posts_by_query',
						nonce: topppa_display_conditions.ajax_nonce
			    	};
				},
				processResults: function (data) {
		            return {
		                results: data
		            };
		        },
			    cache: true
			},
			minimumInputLength: 2,
			language: topppa_display_conditions.topppa_lang
		});
	};

	var update_display_conditions_input = function(wrapper) {
		var new_value = [];
		
		wrapper.find('.topppa-hf__display-condition').each(function(i) {
			
			var $this 			= $(this);
			var temp_obj 		= {};
			var rule_condition 	= $this.find('select.topppa-hf__display-condition-input');
			var specific_page 	= $this.find('select.topppa-hf__display-condition-specific-page');

			var rule_condition_val 	= rule_condition.val();
			var specific_page_val 	= specific_page.val();
			
			if ( '' != rule_condition_val ) {

				temp_obj = {
					type 	: rule_condition_val,
					specific: specific_page_val
				} 
				
				new_value.push( temp_obj );
			};
		})
	};

	var update_close_button = function(wrapper) {

		type 		= wrapper.closest('.topppa-hf__display-condition-container').attr('data-type');
		rules 		= wrapper.find('.topppa-hf__display-condition');
		show_close	= false;

		if ( 'display' == type ) {
			if ( rules.length > 1 ) {
				show_close = true;
			}
		}else{
			show_close = true;
		}

		rules.each(function() {
			if ( show_close ) {
				jQuery(this).find('.topppa-hf__display-condition-delete').removeClass('topppa-hf__element-hidden');
			}else{
				jQuery(this).find('.topppa-hf__display-condition-delete').addClass('topppa-hf__element-hidden');
			}
		});
	};

	var update_exclusion_button = function( force_show, force_hide ) {
		var display_on = $('.topppa-hf__display-condition-display-on-wrap');
		var exclude_on = $('.topppa-hf__display-condition-exclude-on-wrap');
		
		var exclude_field_wrap = exclude_on.closest('tr');
		var add_exclude_block  = display_on.find('.topppa-hf__add-exclude-display-condition-wrapper');
		var exclude_conditions = exclude_on.find('.topppa-hf__display-condition');
		
		if ( true == force_hide ) {
			exclude_field_wrap.addClass( 'topppa-hf__element-hidden' );
			add_exclude_block.removeClass( 'topppa-hf__element-hidden' );
		}else if( true == force_show ){
			exclude_field_wrap.removeClass( 'topppa-hf__element-hidden' );
			add_exclude_block.addClass( 'topppa-hf__element-hidden' );
		}else{
			
			if ( 1 == exclude_conditions.length && '' == $(exclude_conditions[0]).find('select.topppa-hf__display-condition-input').val() ) {
				exclude_field_wrap.addClass( 'topppa-hf__element-hidden' );
				add_exclude_block.removeClass( 'topppa-hf__element-hidden' );
			}else{
				exclude_field_wrap.removeClass( 'topppa-hf__element-hidden' );
				add_exclude_block.addClass( 'topppa-hf__element-hidden' );
			}
		}

	};

	$(document).ready(function($) {

		jQuery( '.topppa-hf__display-condition' ).each( function() {
			var $this 			= $( this ),
				condition 		= $this.find('select.topppa-hf__display-condition-input'),
				condition_val 	= condition.val(),
				specific_page 	= $this.next( '.topppa-hf__display-condition-specific-page-wrapper' );

			if( 'specifics' == condition_val ) {
				specific_page.slideDown( 300 );
			}
		} );

		
		jQuery('select.topppa-hf__display-condition-select2').each(function(index, el) {
			init_display_conditions( el );
		});

		jQuery('.topppa-hf__display-condition-container').each(function() {
			update_close_button( jQuery(this) );
		})

		/* Show hide exclusion button */
		update_exclusion_button();

		jQuery( document ).on( 'change', '.topppa-hf__display-condition select.topppa-hf__display-condition-input' , function( e ) {
			
			var $this 		= jQuery(this),
				this_val 	= $this.val(),
				field_wrap 	= $this.closest('.topppa-hf__display-condition-container');

			if( 'specifics' == this_val ) {
				$this.closest( '.topppa-hf__display-condition' ).next( '.topppa-hf__display-condition-specific-page-wrapper' ).slideDown( 300 );
			} else {
				$this.closest( '.topppa-hf__display-condition' ).next( '.topppa-hf__display-condition-specific-page-wrapper' ).slideUp( 300 );
			}

			update_display_conditions_input( field_wrap );
		} );

		jQuery( '.topppa-hf__display-condition-container' ).on( 'change', '.topppa-hf__display-condition-select2', function(e) {
			var $this 		= jQuery( this ),
				field_wrap 	= $this.closest('.topppa-hf__display-condition-container');

			update_display_conditions_input( field_wrap );
		});
		
		jQuery( '.topppa-hf__display-condition-container' ).on( 'click', '.topppa-hf__add-include-display-condition-wrapper a', function(e) {
			e.preventDefault();
			e.stopPropagation();
			var $this 	= jQuery( this ),
				id 		= $this.attr( 'data-rule-id' ),
				new_id 	= parseInt(id) + 1,
				type 	= $this.attr( 'data-rule-type' ),
				rule_wrap = $this.closest('.topppa-hf__display-condition-container').find('.topppa-hf__display-condition-builder-wrapper'),
				template  = wp.template( 'topppa-hf-display-conditions-' + type + '-condition' ),
				field_wrap 		= $this.closest('.topppa-hf__display-condition-container');

			rule_wrap.append( template( { id : new_id, type : type } ) );
			
			init_display_conditions( '.topppa-hf-display-condition-'+type+'-on .topppa-hf__display-condition-select2' );
			
			$this.attr( 'data-rule-id', new_id );

			update_close_button( field_wrap );
		});

		jQuery( '.topppa-hf__display-condition-container' ).on( 'click', '.topppa-hf__display-condition-delete', function(e) {
			var $this 			= jQuery( this ),
				rule_condition 	= $this.closest('.topppa-hf__display-condition'),
				field_wrap 		= $this.closest('.topppa-hf__display-condition-container');
				cnt 			= 0,
				data_type 		= field_wrap.attr( 'data-type' ),
				optionVal 		= $this.siblings('.topppa-hf__display-condition-wrapper').children('.topppa-hf__display-condition-input').val();

			if ( 'exclude' == data_type ) {
					
				if ( 1 === field_wrap.find('.topppa-hf__display-condition-input').length ) {

					field_wrap.find('.topppa-hf__display-condition-input').val('');
					field_wrap.find('.topppa-hf__display-condition-specific-page').val('');
					field_wrap.find('.topppa-hf__display-condition-input').trigger('change');
					update_exclusion_button( false, true );

				}else{
					$this.parent('.topppa-hf__display-condition').next('.topppa-hf__display-condition-specific-page-wrapper').remove();
					rule_condition.remove();
				}

			} else {

				$this.parent('.topppa-hf__display-condition').next('.topppa-hf__display-condition-specific-page-wrapper').remove();
				rule_condition.remove();
			}

			field_wrap.find('.topppa-hf__display-condition').each(function(i) {
				var condition       = jQuery( this ),
					old_rule_id     = condition.attr('data-rule'),
					select_location = condition.find('.topppa-hf__display-condition-input'),
					select_specific = condition.find('.topppa-hf__display-condition-specific-page'),
					location_name   = select_location.attr( 'name' );
					
				condition.attr( 'data-rule', i );

				select_location.attr( 'name', location_name.replace('['+old_rule_id+']', '['+i+']') );
				
				condition.removeClass('topppa-hf__display-condition-'+old_rule_id).addClass('topppa-hf__display-condition-'+i);

				cnt = i;
			});

			field_wrap.find('.topppa-hf__add-include-display-condition-wrapper a').attr( 'data-rule-id', cnt )

			update_close_button( field_wrap );
			update_display_conditions_input( field_wrap );
		});
		
		jQuery( '.topppa-hf__display-condition-container' ).on( 'click', '.topppa-hf__add-exclude-display-condition-wrapper a', function(e) {
			e.preventDefault();
			e.stopPropagation();
			update_exclusion_button( true );
		});
		
	});

}(jQuery));
