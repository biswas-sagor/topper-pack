<?php
/**
 * Scroll to Top Extension
 *
 * @package Topper Pack
 * @since 1.0.0
 */

namespace TopperPack\Extensions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use \Elementor\Controls_Manager;

class TOPPPA_Scroll_To_Top_Extension {
	public function __construct() {
		$feature_file = TOPPPA_EXTENSIONS_PATH . 'scroll-to-top/scroll-to-top-kit-settings.php';

		if ( is_readable( $feature_file ) ) {
			include_once $feature_file;
		}

		add_action( 'elementor/kit/register_tabs', [ $this, 'init_site_settings' ], 1, 40 );
		add_action( 'elementor/documents/register_controls', [$this, 'scroll_to_top_controls'], 10 );
		add_action( 'wp_footer', [$this, 'render_scroll_to_top_html'] );
	}

	public function scroll_to_top_controls( $element ) {

		$scroll_to_top_global = $this->elementor_get_setting( 'topppa_scroll_to_top_global' );
		if ( 'yes' !== $scroll_to_top_global ) {
			return;
		}

		$element->start_controls_section(
			'topppa_scroll_to_top_single_section',
			[
				'label' => '<span class="topppa-extension-badge"></span>' . __('TOPPPA Scroll to Top', 'topper-pack' ),
				'tab'   => Controls_Manager::TAB_SETTINGS,
			]
		);

		$element->add_control(
			'topppa_scroll_to_top_single_disable',
			[
				'label'        => __( 'Disable Scroll to Top', 'topper-pack' ),
				'description'  => __( 'Disable Scroll to Top For This Page', 'topper-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'topper-pack' ),
				'label_off'    => __( 'No', 'topper-pack' ),
				'return_value' => 'yes',
			]
		);

		$element->end_controls_section();
	}

	public function render_scroll_to_top_html() {

		$post_id                = get_the_ID();
		$document               = [];
		$document_settings_data = [];

		if ( \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
			// get auto save data
			$document = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( $post_id );
		} else {
			$document = \Elementor\Plugin::$instance->documents->get( $post_id, false );
		}
		if ( isset( $document ) && is_object( $document ) ) {
			$document_settings_data = $document->get_settings();
		}

		$scroll_to_top_global = $this->elementor_get_setting( 'topppa_scroll_to_top_global' );

		$scroll_to_top = false;

		if ( 'yes' == $scroll_to_top_global ) {
			$scroll_to_top = true;
		}

		if ( isset( $document_settings_data['topppa_scroll_to_top_single_disable'] ) && 'yes' == $document_settings_data['topppa_scroll_to_top_single_disable'] ) {
			$scroll_to_top = false;
		}

		if ( ! \Elementor\Plugin::instance()->preview->is_preview_mode() && $scroll_to_top ) {

			$stt_media_type = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_media_type' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_media_type' ) : 'icon';
			$stt_icon_html  = '';
			if ( 'icon' == $stt_media_type ) {
				$stt_icon      = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_button_icon' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_button_icon' )['value'] : 'fas fa-chevron-up';
				$stt_icon_html = "<i class='$stt_icon'></i>";
			} elseif ( 'image' == $stt_media_type ) {
				$stt_image     = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_button_image' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_button_image' )['url'] : '';
				$stt_icon_html = "<img src='$stt_image'>"; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
			} elseif ( 'text' == $stt_media_type ) {
				$stt_text      = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_button_text' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_button_text' ) : '';
				$stt_icon_html = "<span>$stt_text</span>";
			}

			$scroll_to_top_html = "<div class='topppa-scroll-to-top-wrap topppa-scroll-to-top-hide'><span class='topppa-scroll-to-top-button'>". wp_kses_post($stt_icon_html) ."</span></div>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			$elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );
			if( (bool)$elementor_page ) {
				printf( '%1$s', wp_kses_post($scroll_to_top_html) ); 
			}

			wp_add_inline_script(
				'bootstrap',
				'!function(o){"use strict";o((function(){o(this).scrollTop()>100&&o(".topppa-scroll-to-top-wrap").removeClass("topppa-scroll-to-top-hide"),o(window).scroll((function(){o(this).scrollTop()<100?o(".topppa-scroll-to-top-wrap").fadeOut(300):o(".topppa-scroll-to-top-wrap").fadeIn(300)})),o(".topppa-scroll-to-top-wrap").on("click",(function(){return o("html, body").animate({scrollTop:0},300),!1}))}))}(jQuery);'
			);
		}

		if ( \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
			if ( $scroll_to_top ) {
				$stt_media_type = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_media_type' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_media_type' ) : 'icon';
				$stt_icon_html  = '';
				if ( 'icon' == $stt_media_type ) {
					$stt_icon      = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_button_icon' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_button_icon' )['value'] : 'fas fa-chevron-up';
					$stt_icon_html = "<i class='$stt_icon'></i>";
				} elseif ( 'image' == $stt_media_type ) {
					$stt_image     = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_button_image' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_button_image' )['url'] : '';
					$stt_icon_html = "<img src='$stt_image'>"; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
				} elseif ( 'text' == $stt_media_type ) {
					$stt_text      = ! empty( $this->elementor_get_setting( 'topppa_scroll_to_top_button_text' ) ) ? $this->elementor_get_setting( 'topppa_scroll_to_top_button_text' ) : '';
					$stt_icon_html = "<span>$stt_text</span>";
				}
				$scroll_to_top_html = "<div class='topppa-scroll-to-top-wrap topppa-scroll-to-top-hide'><span class='topppa-scroll-to-top-button'>$stt_icon_html</span></div>";

				$elementor_page = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );
				if( (bool)$elementor_page ) {
					printf( '%1$s', wp_kses_post($scroll_to_top_html) );
				}
			}
			?>
			<script>
				;(function($) {
					'use strict';
					var markup = '<div class="topppa-scroll-to-top-wrap edit-mode topppa-scroll-to-top-hide"><span class="topppa-scroll-to-top-button"><i class="fas fa-chevron-up"></i></span></div>';
					var stt = jQuery('.topppa-scroll-to-top-wrap');
					if ( ! stt.length ) {
						jQuery('body').append(markup);
					}

					function topppaSanitizeString(input) {
						var htmlTags = /<[^>]*>/g;
						var sanitizedInput = input.replace(htmlTags, "");
						return sanitizedInput;
					}

					function topppaSanitizeURL(url) {
						var urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
						if (url.match(urlPattern)) {
							return url;
						} else {
							return "";
						}
					}

					window.addEventListener('message',function(e) {
						var data = e.data;
						if( 'sttMessage' == data.check ) {
							if (e.origin != window.origin) {
								return;
							}
							if (e.source.location.href != window.parent.location.href) {
								return;
							}
							var sttWrap = jQuery('.topppa-scroll-to-top-wrap');
							var button = sttWrap.find('.topppa-scroll-to-top-button');
							var changeValue = data.changeValue;
							var changeItem = data.changeItem;

							if ( 'topppa_scroll_to_top_single_disable' != changeItem[0] ) {
								var icon = '';
								var image = '';
								var text = '';
								var items = {
									'enable_global_stt' : ('topppa_scroll_to_top_global' == changeItem[0]) ? changeValue : data.enable_global_stt,
									'media_type' : ('topppa_scroll_to_top_media_type' == changeItem[0]) ? changeValue : data.media_type,
									'icon' : ('topppa_scroll_to_top_button_icon' == changeItem[0]) ? changeValue : data.icon,
									'image' : ('topppa_scroll_to_top_button_image' == changeItem[0]) ? changeValue : data.image,
									'text' : ('topppa_scroll_to_top_button_text' == changeItem[0]) ? changeValue : data.text,
								};

								if( 'topppa_scroll_to_top_button_icon' == changeItem[0] ) {
									items.media_type = 'icon';
								} else if( 'topppa_scroll_to_top_button_image' == changeItem[0] ) {
									items.media_type = 'image';
								} else if( 'topppa_scroll_to_top_button_text' == changeItem[0] ) {
									items.media_type = 'text';
								}

								if ('icon' == items.media_type) {
									icon = '<i class="' + topppaSanitizeString(items.icon.value) + '"></i>';
									button.html(icon);
								} else if ('image' == items.media_type) {
									image = '<img src="' + topppaSanitizeURL(items.image.url) + '">'; // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
									button.html(image);
								} else if ('text' == items.media_type) {
									text = '<span>' + topppaSanitizeString(items.text) + '</span>';
									button.html(text);
								}

								if( 'yes' == items.enable_global_stt && sttWrap.hasClass("edit-mode") ) {
									sttWrap.removeClass("edit-mode");
								} else if( '' == changeValue && !sttWrap.hasClass("edit-mode") ) {
									sttWrap.addClass("edit-mode");
								}
							}

							if( 'topppa_scroll_to_top_single_disable' == changeItem[0] ) {
								if( 'yes' == changeValue && !sttWrap.hasClass("single-page-off") ) {
									sttWrap.addClass("single-page-off");
								} else if( '' == changeValue && sttWrap.hasClass("single-page-off") ) {
									sttWrap.removeClass("single-page-off");
								}
							}
						}
					})
				}(jQuery));
				!function(o){"use strict";o((function(){o(this).scrollTop()>100&&o(".topppa-scroll-to-top-wrap").removeClass("topppa-scroll-to-top-hide"),o(window).scroll((function(){o(this).scrollTop()<100?o(".topppa-scroll-to-top-wrap").fadeOut(300):o(".topppa-scroll-to-top-wrap").fadeIn(300)})),o(".topppa-scroll-to-top-wrap").on("click",(function(){return o("html, body").animate({scrollTop:0},300),!1}))}))}(jQuery);
			</script>
			<?php
		}

	}

	public function elementor_get_setting( $setting_id ) {

		$return = '';

		if ( ! isset( $hello_elementor_settings['kit_settings'] ) ) {
			if ( \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
				// get auto save data
				$kit = \Elementor\Plugin::$instance->documents->get_doc_for_frontend( \Elementor\Plugin::$instance->kits_manager->get_active_id() );
			} else {
				$kit = \Elementor\Plugin::$instance->documents->get( \Elementor\Plugin::$instance->kits_manager->get_active_id(), true );
			}
			$hello_elementor_settings['kit_settings'] = $kit->get_settings();
		}

		if ( isset( $hello_elementor_settings['kit_settings'][ $setting_id ] ) ) {
			$return = $hello_elementor_settings['kit_settings'][ $setting_id ];
		}

		return $return;
	}

	public function init_site_settings( \Elementor\Core\Kits\Documents\Kit $kit ) {
		$kit->register_tab( 'topppa-scroll-to-top-kit-settings', TOPPPA_Scroll_To_Top_Extension_Kit_Setings::class );
	}

}
new TOPPPA_Scroll_To_Top_Extension();