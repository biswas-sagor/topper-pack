<?php
/**
 * TOPPPA Theme Builder's Admin part.
 *
 * @package  TopperPack_For_Elementor
 * @package  TopperPack_For_Elementor
 */

namespace TopperPack_For_Elementor\Admin\Theme_Builder;

use TopperPack\Includes\Theme_Builder\Conditions\TOPPPA_Conditions;
use TopperPack\Includes\Theme_Builder\TOPPPA_Theme_Builder;
use TopperPack\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class TOPPPA_Theme_Builder_Admin {
	use Singleton;

	public $post_type = 'topppa-theme-builder';

	public $type_tax = 'template_type';

	private function __construct() {
		add_action( 'init', array( $this, 'register_topppa_theme_builder_posttype' ) );
		add_filter( 'views_edit-' . $this->post_type, array( $this, 'print_type_tabs' ) );
		add_filter( 'parse_query', array( $this, 'prefix_parse_filter' ) );
		add_action( 'add_meta_boxes', array( $this, 'topppa_hf_register_metabox' ) );
		add_action( 'save_post', array( $this, 'topppa_hf_save_meta_data' ) );
		add_action( 'admin_notices', array( $this, 'location_notice' ) );
		add_action( 'template_redirect', array( $this, 'block_template_frontend' ) );
		add_filter( 'single_template', array( $this, 'load_canvas_template' ) );
		add_filter( 'manage_topppa-theme-builder_posts_columns', array( $this, 'add_shortcode_column' ) );
		add_filter( 'manage_topppa-theme-builder_posts_columns', array( $this, 'add_type_column' ) );
		add_action( 'manage_topppa-theme-builder_posts_custom_column', array( $this, 'render_shortcode_column' ), 10, 2 );
		add_action( 'manage_topppa-theme-builder_posts_custom_column', array( $this, 'render_type_column' ), 10, 2 );
		if ( defined( 'ELEMENTOR_PRO_VERSION' ) && ELEMENTOR_PRO_VERSION > 2.8 ) {
			add_action( 'elementor/editor/footer', array( $this, 'register_topppa_epro_script' ), 99 );
		}

		if ( is_admin() ) {
			add_action( 'manage_topppa-theme-builder_posts_custom_column', array( $this, 'render_column_content' ), 10, 2 );
			add_filter( 'manage_topppa-theme-builder_posts_columns', array( $this, 'add_column_headings' ) );
		}
	}

	public function prefix_parse_filter( $query ) {
		global $pagenow;
		$current_page = isset( $_GET[ $this->type_tax ] ) ? sanitize_text_field(wp_unslash($_GET[ $this->type_tax ])) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( is_admin() &&
			'edit.php' == $pagenow &&
			isset( $_GET[ $this->type_tax ] ) && // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$_GET[ $this->type_tax ] != '' ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$query->query_vars['meta_key']     = 'topppa_hf_template_type'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$query->query_vars['meta_value']   = $current_page; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value
			$query->query_vars['meta_compare'] = '=';
		}
	}

	public function print_type_tabs( $edit_links ) {

		$tabs = array(
			'all'             => esc_html__('All', 'topper-pack'),
			'header'          => esc_html__('Header', 'topper-pack'),
			'footer'          => esc_html__('Footer', 'topper-pack'),
			'page-title' 		=> esc_html__('Page Title', 'topper-pack'),
			'single-page'     => esc_html__('Single Page', 'topper-pack'),
			'single-post'     => esc_html__('Single Post', 'topper-pack'),
			'error-404'       => esc_html__('Error 404', 'topper-pack'),
			'archive'         => esc_html__('Archive', 'topper-pack'),
		);
		
		// If premium
		if (topppa_can_use_premium_features()) {
			$page_title_tab = array(
				'product-archive' => esc_html__('Product Archive', 'topper-pack'),
				'single-product'  => esc_html__('Single Product', 'topper-pack'),
				'cart'            => esc_html__('Cart', 'topper-pack'),
				'checkout'        => esc_html__('Checkout', 'topper-pack'),
			);
			
			// Insert after 'footer'
			$tabs = array_slice($tabs, 0, 8, true) + $page_title_tab + array_slice($tabs, 8, null, true);
		}

		
		$active_tab = isset( $_GET[ $this->type_tax ] ) ? sanitize_text_field(wp_unslash($_GET[ $this->type_tax ])) : 'all'; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$page_link  = admin_url( 'edit.php?post_type=' . $this->post_type );

		if ( ! array_key_exists( $active_tab, $tabs ) ) {
			$active_tab = 'all';
		} ?>

		<div class="nav-tab-wrapper jet-library-tabs">
			<?php
			foreach ( $tabs as $tab => $label ) {

				$class = 'nav-tab';

				if ( $tab === $active_tab ) {
					$class .= ' nav-tab-active';
				}

				if ( 'all' !== $tab ) {
					$link = add_query_arg( array( $this->type_tax => $tab ), $page_link );
				} else {
					$link = $page_link;
				}

				printf( '<a href="%1$s" class="%3$s">%2$s</a>', esc_url( $link ), esc_html( $label ), esc_attr( $class ) );

			}
			?>
		</div>
		<br>
		<?php
		return $edit_links;
	}

	public function register_topppa_epro_script() {
		$ids = array(
			array(
				'id'    => get_topppa_header_id(),
				'value' => esc_html__( 'Header', 'topper-pack' ),
			),
			array(
				'id'    => get_topppa_footer_id(),
				'value' => esc_html__( 'Footer', 'topper-pack' ),
			),
			array(
				'id'    => get_topppa_page_title_id(),
				'value' => esc_html__( 'Page Title', 'topper-pack' ),
			),
			array(
				'id'    => get_topppa_single_page_id(),
				'value' => esc_html__( 'Single Page', 'topper-pack' ),
			),
			array(
				'id'    => get_topppa_single_post_id(),
				'value' => esc_html__( 'Single Post', 'topper-pack' ),
			),
			array(
				'id'    => get_topppa_error_404_id(),
				'value' => esc_html__( 'Error 404', 'topper-pack' ),
			),
			array(
				'id'    => get_topppa_archive_id(),
				'value' => esc_html__( 'Archive', 'topper-pack' ),
			),
		);
		// Single product and product archive will be added in $ids array when woocommerce is activated.
		if ( class_exists( 'WooCommerce' ) ) {
			array_push(
				$ids,
				array(
					'id'    => get_topppa_single_product_id(),
					'value' => esc_html__( 'Single Product', 'topper-pack' ),
				),
				array(
					'id'    => get_topppa_product_archive_id(),
					'value' => esc_html__( 'Product Archive', 'topper-pack' ),
				),
			);

		}
		wp_localize_script(
			'topppa-hf-epro-compatibility',
			'topppa_Theme_Builder_admin',
			array(
				'ids' => wp_json_encode( $ids ),
			)
		);
	}

	public function add_column_headings( $columns ) {
		unset( $columns['date'] );

		$columns['topppa_hf_template_display_conditions'] = esc_html__( 'Display Conditions', 'topper-pack' );
		$columns['date']                                = esc_html__( 'Date', 'topper-pack' );

		return $columns;
	}

	public function render_column_content( $column, $post_id ) {

		if ( 'topppa_hf_template_display_conditions' === $column ) {

			$locations = get_post_meta( $post_id, 'topppa_hf_include_locations', true );
			if ( ! empty( $locations ) ) {
				echo '<div class="topppa-hf__admin-column-include-locations-wrapper" style="margin-bottom: 5px;">';
				echo '<strong>' . esc_html__( 'Display: ', 'topper-pack' ) . '</strong>';
				$this->column_display_location_rules( $locations );
				echo '</div>';
			}

			$locations = get_post_meta( $post_id, 'topppa_hf_exclude_locations', true );
			if ( ! empty( $locations ) ) {
				echo '<div class="topppa-hf__admin-column-exclude-locations-wrapper" style="margin-bottom: 5px;">';
				echo '<strong>' . esc_html__( 'Exclude: ', 'topper-pack' ) . '</strong>';
				$this->column_display_location_rules( $locations );
				echo '</div>';
			}

			$users = get_post_meta( $post_id, 'topppa_hf_target_user_roles', true );
			if ( isset( $users ) && is_array( $users ) ) {
				if ( isset( $users[0] ) && ! empty( $users[0] ) ) {
					$user_label = array();
					foreach ( $users as $user ) {
						$user_label[] = TOPPPA_Conditions::get_user_by_key( $user );
					}
					echo '<div class="topppa-hf__admin-column-target-users-wrapper">';
					echo '<strong>' . esc_html__( 'Users: ', 'topper-pack' ) . '</strong>';
					echo join( ', ', $user_label ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '</div>';
				}
			}
		}
	}

	public function column_display_location_rules( $locations ) {

		$location_label = array();
		$index          = array_search( 'specifics', $locations['rule'] ); // phpcs:ignore
		if ( false !== $index && ! empty( $index ) ) {
			unset( $locations['rule'][ $index ] );
		}

		if ( isset( $locations['rule'] ) && is_array( $locations['rule'] ) ) {
			foreach ( $locations['rule'] as $location ) {
				$location_label[] = TOPPPA_Conditions::get_location_by_key( $location );
			}
		}
		if ( isset( $locations['specific'] ) && is_array( $locations['specific'] ) ) {
			foreach ( $locations['specific'] as $location ) {
				$location_label[] = TOPPPA_Conditions::get_location_by_key( $location );
			}
		}

		echo join( ', ', $location_label ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	public function register_topppa_theme_builder_posttype() {
		$labels = array(
			'name'               => esc_html__( 'Theme Builder', 'topper-pack' ),
			'singular_name'      => esc_html__( 'Theme Builder', 'topper-pack' ),
			'menu_name'          => esc_html__( 'Theme Template', 'topper-pack' ),
			'name_admin_bar'     => esc_html__( 'Theme Template', 'topper-pack' ),
			'add_new'            => esc_html__( 'Add New', 'topper-pack' ),
			'add_new_item'       => esc_html__( 'Add New Template', 'topper-pack' ),
			'new_item'           => esc_html__( 'New Template', 'topper-pack' ),
			'edit_item'          => esc_html__( 'Edit Template', 'topper-pack' ),
			'view_item'          => esc_html__( 'View Template', 'topper-pack' ),
			'all_items'          => esc_html__( 'All Templates', 'topper-pack' ),
			'search_items'       => esc_html__( 'Search Templates', 'topper-pack' ),
			'parent_item_colon'  => esc_html__( 'Parent Template:', 'topper-pack' ),
			'not_found'          => esc_html__( 'No Templates found.', 'topper-pack' ),
			'not_found_in_trash' => esc_html__( 'No Templates found in Trash.', 'topper-pack' ),
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => false,
			'show_in_nav_menus'   => false,
			'exclude_from_search' => true,
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'rewrite'             => false,
			'supports'            => array( 'title', 'thumbnail', 'elementor' ),
		);

		register_post_type( 'topppa-theme-builder', $args );
	}

	public function get_help_url() {
		return 'https://doc.topperpack.com/docs/theme-builder/';
	}

	public function topppa_hf_register_metabox() {
		$help_url     = $this->get_help_url();
		$help_element = '<a href="' . esc_url( $help_url ) . '" class="topppa-hf__need-help" target="_blank">Need Help?</a>';

		add_meta_box(
			'topppa-hf-meta-box',
			// translators: %1$s represents the help element.
			sprintf( __( 'Template Meta Settings %1$s', 'topper-pack' ), $help_element ),
			array(
				$this,
				'topppa_hf_metabox_render',
			),
			'topppa-theme-builder',
			'normal',
			'high'
		);
	}

	public function topppa_hf_metabox_render( $post ) {
		$values            = get_post_custom( $post->ID );
		$template_type     = isset( $values['topppa_hf_template_type'] ) ? esc_attr( $values['topppa_hf_template_type'][0] ) : '';
		$display_on_canvas = isset( $values['topppa-hf__enable-for-canvas'] ) ? true : false;

		// We'll use this nonce field later on when saving.
		wp_nonce_field( 'topppa_hf_meta_nonce', 'topppa_hf_meta_nonce' );
		?>
		<table class="topppa-hf__meta-options-table widefat">
			<tbody>
				<tr class="topppa-hf__meta-options-row type-of-template">
					<td class="topppa-hf__meta-options-row-heading">
						<label for="topppa_hf_template_type"><?php esc_html_e( 'Type of Template', 'topper-pack' ); ?></label>
					</td>
					<td class="topppa-hf__meta-options-row-body">
						<select name="topppa_hf_template_type" id="topppa_hf_template_type">
							<option value="" <?php selected( $template_type, '' ); ?>><?php esc_html_e( 'Select Template type', 'topper-pack' ); ?></option>
							<option value="header" <?php selected( $template_type, 'header' ); ?>><?php esc_html_e( 'Header', 'topper-pack' ); ?></option>
							<option value="footer" <?php selected( $template_type, 'footer' ); ?>><?php esc_html_e( 'Footer', 'topper-pack' ); ?></option>
							<option value="page-title" <?php selected( $template_type, 'page-title' ); ?>><?php esc_html_e( 'Page Title', 'topper-pack' ); ?></option>
							<option value="single-page" <?php selected( $template_type, 'single-page' ); ?>><?php esc_html_e( 'Single Page', 'topper-pack' ); ?></option>
							<option value="single-post" <?php selected( $template_type, 'single-post' ); ?>><?php esc_html_e( 'Single Post', 'topper-pack' ); ?></option>
							<option value="error-404" <?php selected( $template_type, 'error-404' ); ?>><?php esc_html_e( 'Error 404', 'topper-pack' ); ?></option>
							<option value="archive" <?php selected( $template_type, 'archive' ); ?>><?php esc_html_e( 'Archive', 'topper-pack' ); ?></option>
							<?php if (topppa_can_use_premium_features()) : ?>
								<option value="product-archive" <?php selected( $template_type, 'product-archive' ); ?>><?php esc_html_e( 'Product  Archive', 'topper-pack' ); ?></option>
								<option value="single-product" <?php selected( $template_type, 'single-product' ); ?>><?php esc_html_e( 'Single Product', 'topper-pack' ); ?></option>
								<option value="cart" <?php selected( $template_type, 'cart' ); ?>><?php esc_html_e( 'Cart', 'topper-pack' ); ?></option>
								<option value="checkout" <?php selected( $template_type, 'checkout' ); ?>><?php esc_html_e( 'Checkout', 'topper-pack' ); ?></option>
							<?php endif; ?>
						</select>
					</td>
				</tr>

				<?php $this->display_rules_tab(); ?>
				<tr class="topppa-hf__meta-options-row topppa-hf__shortcode">
					<td class="topppa-hf__meta-options-row-heading">
						<label for="topppa-hf__template-shortcode"><?php esc_html_e( 'Shortcode', 'topper-pack' ); ?></label>
						<i class="topppa-hf__meta-options-row-heading-help dashicons dashicons-editor-help" title="<?php esc_html__( 'Copy this shortcode and paste it into your post, page, or text widget content.', 'topper-pack' ); ?>">
						</i>
					</td>
					<td class="topppa-hf__meta-options-row-body">
						<span class="topppa-hf__shortcode-column">
							<input type="text" onfocus="this.select();" readonly="readonly" value="[topppa_theme_builder id='<?php echo esc_attr( $post->ID ); ?>']" class="topppa-hf__template-shortcode code">
						</span>
					</td>
				</tr>
				<tr class="topppa-hf__meta-options-row topppa-hf__enable-for-canvas">
					<td class="topppa-hf__meta-options-row-heading">
						<label for="topppa-hf__enable-for-canvas">
							<?php esc_html_e( 'Enable Layout for Elementor Canvas Template?', 'topper-pack' ); ?>
						</label>
						<i class="topppa-hf__meta-options-row-heading-help dashicons dashicons-editor-help" title="<?php esc_html_e( 'Enabling this option will allow you to display this template on pages using Elementor Canvas Template.', 'topper-pack' ); ?>"></i>
					</td>
					<td class="topppa-hf__meta-options-row-body">
						<input type="checkbox" id="topppa-hf__enable-for-canvas" name="topppa-hf__enable-for-canvas" value="1" <?php checked( $display_on_canvas, true ); ?> />
					</td>
				</tr>
			</tbody>
		</table>
		<?php
	}

	public function display_rules_tab() {
		// Load Display Conditions assets.
		TOPPPA_Conditions::instance()->admin_styles();

		$include_locations = get_post_meta( get_the_id(), 'topppa_hf_include_locations', true );
		$exclude_locations = get_post_meta( get_the_id(), 'topppa_hf_exclude_locations', true );
		$users             = get_post_meta( get_the_id(), 'topppa_hf_target_user_roles', true );
		?>
		<tr class="topppa-hf__display-condition-row topppa-hf__meta-options-row">
			<td class="topppa-hf__display-condition-row-heading topppa-hf__meta-options-row-heading">
				<label><?php esc_html_e( 'Display On', 'topper-pack' ); ?></label>
				<i class="topppa-hf__display-condition-row-heading-help dashicons dashicons-editor-help"
					title="<?php echo esc_attr__( 'Add the location(s) for where this template should appear.', 'topper-pack' ); ?>"></i>
			</td>
			<td class="topppa-hf__display-condition-row-body topppa-hf__meta-options-row-body">
				<?php
				TOPPPA_Conditions::target_rule_settings_field(
					'topppa-hf-include-locations',
					array(
						'title'          => esc_html__( 'Display Rules', 'topper-pack' ),
						'value'          => '[{"type":"basic-global","specific":null}]',
						'tags'           => 'site,enable,target,pages',
						'rule_type'      => 'display',
						'add_rule_label' => esc_html__( 'Add Display On Condition', 'topper-pack' ),
					),
					$include_locations
				);
				?>
			</td>
		</tr>
		<tr class="topppa-hf__display-condition-row topppa-hf__meta-options-row">
			<td class="topppa-hf__display-condition-row-heading topppa-hf__meta-options-row-heading">
				<label><?php esc_html_e( 'Do Not Display On', 'topper-pack' ); ?></label>
				<i class="topppa-hf__display-condition-row-heading-help dashicons dashicons-editor-help"
					title="<?php echo esc_attr__( 'Add the location(s) for where this template should not appear.', 'topper-pack' ); ?>"></i>
			</td>
			<td class="topppa-hf__display-condition-row-body topppa-hf__meta-options-row-body">
				<?php
				TOPPPA_Conditions::target_rule_settings_field(
					'topppa-hf-exclude-locations',
					array(
						'title'          => esc_html__( 'Exclude On', 'topper-pack' ),
						'value'          => '[]',
						'tags'           => 'site,enable,target,pages',
						'add_rule_label' => esc_html__( 'Add Exclusion Rule', 'topper-pack' ),
						'rule_type'      => 'exclude',
					),
					$exclude_locations
				);
				?>
			</td>
		</tr>
		<tr class="topppa-hf__user-role-condition-row topppa-hf__meta-options-row">
			<td class="topppa-hf__user-role-condition-row-heading topppa-hf__meta-options-row-heading">
				<label><?php esc_html_e( 'User Roles', 'topper-pack' ); ?></label>
				<i class="topppa-hf__user-role-condition-heading-help dashicons dashicons-editor-help" title="<?php echo esc_attr__( 'Display this template based on user role(s).', 'topper-pack' ); ?>"></i>
			</td>
			<td class="topppa-hf__user-role-condition-body topppa-hf__meta-options-row-body">
				<?php
				TOPPPA_Conditions::target_user_role_settings_field(
					'topppa-hf-target-user-roles',
					array(
						'title'          => esc_html__( 'Users', 'topper-pack' ),
						'value'          => '[]',
						'tags'           => 'site,enable,target,pages',
						'add_rule_label' => esc_html__( 'Add User Rule', 'topper-pack' ),
					),
					$users
				);
				?>
			</td>
		</tr>
		<?php
	}

	public function topppa_hf_save_meta_data( $post_id ) {

		// Bail if we're doing an auto save.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// if our nonce isn't there, or we can't verify it, bail.
		if ( ! isset( $_POST['topppa_hf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['topppa_hf_meta_nonce'], 'topppa_hf_meta_nonce' ) ) { // phpcs:ignore
			return;
		}

		// if our current user can't edit this post, bail.
		if ( ! current_user_can( 'edit_posts' ) ) {
			return;
		}

		$target_locations = TOPPPA_Conditions::get_format_rule_value( $_POST, 'topppa-hf-include-locations' );
		$target_exclusion = TOPPPA_Conditions::get_format_rule_value( $_POST, 'topppa-hf-exclude-locations' );
		$target_users     = array();

		if ( isset( $_POST['topppa-hf-target-user-roles'] ) ) {
			$target_users = array_map( 'sanitize_text_field', $_POST['topppa-hf-target-user-roles'] ); // phpcs:ignore
		}

		update_post_meta( $post_id, 'topppa_hf_include_locations', $target_locations );
		update_post_meta( $post_id, 'topppa_hf_exclude_locations', $target_exclusion );
		update_post_meta( $post_id, 'topppa_hf_target_user_roles', $target_users );

		if ( isset( $_POST['topppa_hf_template_type'] ) ) {
			update_post_meta( $post_id, 'topppa_hf_template_type', esc_attr( $_POST['topppa_hf_template_type'] ) ); // phpcs:ignore
		}

		if ( isset( $_POST['topppa-hf__enable-for-canvas'] ) ) {
			update_post_meta( $post_id, 'topppa-hf__enable-for-canvas', esc_attr( $_POST['topppa-hf__enable-for-canvas'] ) ); // phpcs:ignore
		} else {
			delete_post_meta( $post_id, 'topppa-hf__enable-for-canvas' );
		}
	}

	public function location_notice() {
		global $pagenow;
		global $post;

		if ( 'post.php' !== $pagenow || ! is_object( $post ) || 'topppa-theme-builder' !== $post->post_type ) {
			return;
		}

		$template_type = get_post_meta( $post->ID, 'topppa_hf_template_type', true );

		if ( '' !== $template_type ) {
			$templates = TOPPPA_Theme_Builder::get_template_id( $template_type );

			// Check if more than one template is selected for current template type.
			if ( is_array( $templates ) && isset( $templates[1] ) && $post->ID == $templates[0] ) { // phpcs:ignore
				echo '<div class="notice notice-warning is-dismissible"><p>';
				echo esc_html__( 'A template already exists with same display conditions, creating this will override the previous template.', 'topper-pack' );
				echo '</p></div>';
			}
		}
	}

	public function template_location( $template_type ) {
		$template_type = ucfirst( $template_type );

		return $template_type;
	}

	public function block_template_frontend() {
		if ( is_singular( 'topppa-theme-builder' ) && ! current_user_can( 'edit_posts' ) ) {
			wp_redirect( site_url(), 301 ); // phpcs:ignore
			die;
		}
	}

	public function load_canvas_template( $single_template ) {
		global $post;

		if ( 'topppa-theme-builder' === $post->post_type ) {
			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}

	public function add_type_column( $columns ) {
		$date_column = $columns['date'];

		unset( $columns['date'] );

		$columns['type'] = esc_html__( 'Type', 'topper-pack' );
		$columns['date'] = $date_column;

		return $columns;
	}

	public function add_shortcode_column( $columns ) {
		$date_column = $columns['date'];

		unset( $columns['date'] );

		$columns['shortcode'] = esc_html__( 'Shortcode', 'topper-pack' );
		$columns['date']      = $date_column;

		return $columns;
	}

	public function render_shortcode_column( $column, $post_id ) {
		switch ( $column ) {
			case 'shortcode':
				?>
				<span class="topppa-hf__shortcode-column">
					<input type="text" onfocus="this.select();" readonly="readonly" value="[topppa_theme_builder id='<?php echo esc_attr( $post_id ); ?>']" class="topppa-hf__template-shortcode code">
				</span>
				<?php
				break;
		}
	}

	public function render_type_column( $column, $post_id ) {
		switch ( $column ) {
			case 'type':
				$template_type = esc_html( get_post_meta( $post_id, 'topppa_hf_template_type', true ) );
				?>
				<span class="topppa-hf__type-column">
					<a
					class="topppa-hf__template-type"
					href="<?php echo esc_url( admin_url( 'edit.php?post_type=' . $this->post_type . '&' . $this->type_tax . '=' . $template_type ) ); ?>">
					<?php echo esc_html( ucwords( str_replace( '-', ' ', $template_type ) ) ); ?></a>
				</span>
				<?php
				break;
		}
	}
}

TOPPPA_Theme_Builder_Admin::instance();
