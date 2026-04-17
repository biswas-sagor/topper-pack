(function ($) {
	"use strict";

	// Hide theme's default page title elements
	function topppa_hide_default_page_title() {
		// Common selectors for theme page titles
		var defaultTitleSelectors = [
			'.breadcum-area',
			'.breadcroumb-area',
			'.entry-hero',
			'.clr.page-header-inner',
			'.ocean-single-post-header',
			'.site-main.clr .page-header',
			'.breadcrumb-area',
			'.wp-theme-hello-elementor .page-header',
		];

		// Hide each found element
		defaultTitleSelectors.forEach(function (selector) {
			var elements = document.querySelectorAll(selector);
			elements.forEach(function (element) {
				// Only hide if it's not our custom page title
				if (!element.closest('.topppa-page-title-after-header')) {
					element.style.display = 'none';
				}
			});
		});
	}

	// Page title positioning function
	function topppa_position_page_title() {
		// Only run if page title content exists
		if (typeof topppa_page_title_content !== 'undefined') {
			// First hide the default theme page title
			topppa_hide_default_page_title();

			// Create page title container
			var pageTitleWrapper = document.createElement('div');
			pageTitleWrapper.className = 'topppa-page-title-after-header';
			pageTitleWrapper.innerHTML = topppa_page_title_content;

			// Find where to insert - try multiple selectors
			var insertAfter = document.querySelector('header') ||
				document.querySelector('.site-header') ||
				document.querySelector('#masthead') ||
				document.querySelector('.topppa-site-header');

			if (insertAfter) {
				// Insert after header
				insertAfter.parentNode.insertBefore(pageTitleWrapper, insertAfter.nextSibling);
			} else {
				// Fallback: insert at top of body
				var body = document.body;
				body.insertBefore(pageTitleWrapper, body.firstChild);
			}
		}
	}

	// Run page title positioning when DOM is ready
	$(document).ready(function () {
		topppa_position_page_title();
	});

})(jQuery); 