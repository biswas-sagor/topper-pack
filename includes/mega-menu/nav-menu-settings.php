<?php
/**
 * Mega Menu Settings
 * @package Topper Pack
 * @since 1.0.0
 */
defined('ABSPATH') || exit;

?>
<div class="topppa-mega-menu-settings-modal">
	<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox elementor-templates-modal topppa-dynamic-content-modal" id="elementor-template-nav-menu-modal-container" style="display:none">
		<div class="dialog-widget-content dialog-lightbox-widget-content">

			<div class="elementor-templates-modal__header">
				<div class="elementor-templates-modal__header__logo__title"><?php esc_html_e('TOPPPA Mega Menu Settings', 'topper-pack'); ?></div>
				<div class="elementor-templates-modal__header__close elementor-templates-modal__header__close--normal elementor-templates-modal__header__item">
					<i class="eicon-close" aria-hidden="true" title="<?php echo esc_attr__('Close', 'topper-pack'); ?>"></i>
					<span class="elementor-screen-only"><?php esc_html_e('Close', 'topper-pack'); ?></span>
				</div>
			</div>

			<div class="dialog-message dialog-lightbox-message">
				<div class="dialog-content dialog-lightbox-content" style="display: block;">
					<div id="elementor-template-library-templates" data-template-source="remote">
						<div id="elementor-template-library-templates-container">

							<div class="topppa-megamenu-editor-top-container">
								<div class="topppa-megamenu-settings topppa-setting-container">
									<div class="topppa-megamenu-settings-eidtor-wrapper topppa-megamenu-editor-container-flex">
										<div class="topppa-mega-menu-control-meta">
											<label for="topppa-megamenu-switcher"><?php esc_html_e('Enable Mega Menu', 'topper-pack'); ?></label>
										</div>
										<div class="topppa-mega-menu-control" id="topppa-megamenu-switcher">
											<label class="switch">
												<input type="checkbox">
												<span class="slider round topppa-control"></span>
											</label>
										</div>
									</div>
									<div class="topppa-mega-menu-control topppa-megamenu-editor-content-button" id="topppa-megamenu-content">
										<span class="topppa-mega-menu-btn"><?php esc_html_e('Edit Mega Content', 'topper-pack'); ?></span>
									</div>
								</div>


								<div class="topppa-megamenu-settings topppa-setting-container topppa-megamenu-editor-container-flex ">
									<div class="topppa-mega-menu-control-meta topppa-has-desc">
										<label for="topppa-megamenu-content-pos"><?php esc_html_e('Menu Content Position', 'topper-pack'); ?></label>
										<div class="topppa-megamenu-des"><?php esc_html_e('mega content parent position', 'topper-pack'); ?></div>
									</div>
									<div class="topppa-mega-menu-control topppa-megamenu-input-control" id="topppa-megamenu-content-pos">
										<select id="topppa-megamenu-position">
											<option value="default">Default</option>
											<option value="relative">Relative</option>
										</select>
									</div>
								</div>

								<div class="topppa-megamenu-settings topppa-setting-container topppa-depth-0-control topppa-setting-hidden topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta topppa-has-desc">
										<label for="topppa-megamenu-content-pos"><?php esc_html_e('Full Width Content', 'topper-pack'); ?></label>
										<div class="topppa-megamenu-des"><?php esc_html_e('Works only on horizontal-layout menus', 'topper-pack'); ?></div>
									</div>
									<div class="topppa-mega-menu-control" id="topppa-full-width-switcher">
										<label class="switch">
											<input type="checkbox">
											<span class="slider round topppa-control"></span>
										</label>
									</div>
								</div>

								<div class="topppa-megamenu-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta topppa-has-desc">
										<label for="topppa-megamenu-content-width"><?php esc_html_e('Menu Content Width (PX)', 'topper-pack'); ?></label>
										<div class="topppa-megamenu-des"><?php esc_html_e('Default is 1170 px', 'topper-pack'); ?></div>
									</div>
									<div class="topppa-mega-menu-control topppa-megamenu-input-control" id="topppa-megamenu-content-width">
										<input type="number" id="topppa-mega-content-width" min="1" max="2000">
									</div>
								</div>
							</div>

							<div class="topppa-megamenu-editor-icon-wrapper">
								<div class="topppa-megamenu-eidtor-title"><?php esc_html_e('Icon Settings', 'topper-pack'); ?></div>
								<div class="topppa-icon-select topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta">
										<label for="topppa-item-icon-type"><?php esc_html_e('Icon Type', 'topper-pack'); ?></label>
									</div>
									<div class="topppa-mega-menu-control topppa-megamenu-input-control" id="topppa-item-icon-type">
										<select id="topppa-megamenu-icon-type">
											<option value="icon">Icon</option>
											<option value="lottie">Lottie Animation</option>
										</select>
									</div>
								</div>

								<div class="topppa-lottie-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta topppa-has-desc">
										<label for="topppa-item-lottie"><?php esc_html_e('Lottie URL', 'topper-pack'); ?></label>
										<div class="topppa-megamenu-des"><?php echo wp_kses_post('Get JSON code URL from <a href="https://lottiefiles.com/" target="_blank">here</a>', 'topper-pack'); ?></div>
									</div>
									<div class="topppa-mega-menu-control topppa-megamenu-input-control" id="topppa-item-lottie">
										<input type="text" id="topppa-lottie-url" class="topppa-icon-picker">
									</div>
								</div>

								<div class="topppa-icon-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta">
										<label for="topppa-item-icon-picker"><?php esc_html_e('Select Icon', 'topper-pack'); ?></label>
									</div>
									<div class="topppa-mega-menu-control" id="topppa-item-icon-picker">
										<input type="text" id="topppa-icon-field" class="topppa-icon-picker">
									</div>
								</div>

								<div class="topppa-icon-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta">
										<label for="topppa-item-icon-color"><?php esc_html_e('Icon Color', 'topper-pack'); ?></label>
									</div>
									<div class="topppa-mega-menu-control" id="topppa-item-icon-color">
										<input type="text" id="topppa-icon-color-field" class="topppa-color-picker" value="#0E59F2">
									</div>
								</div>
							</div>

							<div class="topppa-megamenu-editor-badge-wrapper">
								<div class="topppa-megamenu-eidtor-title"><?php esc_html_e('Badge Settings', 'topper-pack'); ?></div>
								<div class="topppa-badge-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta">
										<label for="topppa-badge-text-field"><?php esc_html_e('Item Badge Text', 'topper-pack'); ?></label>
									</div>
									<div class="topppa-mega-menu-control topppa-megamenu-input-control" id="topppa-item-badge">
										<input type="text" id="topppa-badge-text-field" class="topppa-text-picker" placeholder="Badge Text">
									</div>
								</div>

								<div class="topppa-badge-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta">
										<label for="topppa-badge-color-field"><?php esc_html_e('Badge Color', 'topper-pack'); ?></label>
									</div>
									<div class="topppa-mega-menu-control" id="topppa-item-badge-color">
										<input type="text" id="topppa-badge-color-field" class="topppa-color-picker" value="#bada55">
									</div>
								</div>

								<div class="topppa-badge-settings topppa-setting-container topppa-megamenu-editor-container-flex">
									<div class="topppa-mega-menu-control-meta">
										<label for="topppa-badge-bg-field"><?php esc_html_e('Badge Background', 'topper-pack'); ?></label>
									</div>
									<div class="topppa-mega-menu-control" id="topppa-item-badge-color">
										<input type="text" id="topppa-badge-bg-field" class="topppa-color-picker" value="#0E59F2">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="topppa-mega-menu-dialog-footer">
				<div class="topppa-mega-menu-save-btn">
					<button id="topppa-mega-menu-save" class="topppa-mega-menu-btn" type="button">
						<span>
							<?php esc_html_e('Save Settings', 'topper-pack'); ?>
						</span>
						<i class="dashicons dashicons-admin-generic loader-hidden"></i>
						</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php defined('ABSPATH') || exit; ?>
<div class="topppa-live-editor-iframe-modal">
	<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox elementor-templates-modal topppa-dynamic-content-modal" id="elementor-template-topppa-live-editor-modal-container" style="display:none">
		<div class="dialog-widget-content dialog-lightbox-widget-content">
			<div class="topppa-mega-menu-temp-close">
				<i class="eicon-close"></i>
			</div>
			<div class="dialog-message dialog-lightbox-message">
				<div class="dialog-content dialog-lightbox-content" style="display: block;">
					<div id="elementor-template-library-templates" data-template-source="remote">

						<div id="elementor-template-library-templates-container">
							<iframe id="topppa-live-editor-control-iframe"></iframe>
						</div>
					</div>
				</div>
				<div class="dialog-loading dialog-lightbox-loading" style="display: block;">
					<div id="elementor-template-library-loading">
						<div class="elementor-loader-wrapper">
							<div class="elementor-loader">
								<div class="elementor-loader-boxes">
									<div class="elementor-loader-box"></div>
									<div class="elementor-loader-box"></div>
									<div class="elementor-loader-box"></div>
									<div class="elementor-loader-box"></div>
								</div>
							</div>
							<div class="elementor-loading-title"><?php esc_html_e('Loading', 'topper-pack'); ?></div>
						</div>
					</div>
				</div>
			</div>
			<div class="dialog-buttons-wrapper dialog-lightbox-buttons-wrapper"></div>
		</div>
	</div>
</div>