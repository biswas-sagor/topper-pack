(function($) {
    'use strict';

    // Global variables
    let topppaCurrentStep = 'welcome';
    let topppaSelectedWidgets = [];
    let topppaSelectedExtensions = [];
    let topppaLoading = false;

    // Initialize wizard when document is ready
    $(document).ready(function() {
        topppaInitializeWizard();
        topppaSetupEventListeners();
        topppaLoadSavedSelections();
        
        // Ensure checkboxes are properly synced with PHP defaults on first load
        setTimeout(function() {
            topppaSyncCheckboxesWithDefaults();
        }, 100);
    });

    function topppaInitializeWizard() {
        // Get current step from URL
        const urlParams = new URLSearchParams(window.location.search);
        topppaCurrentStep = urlParams.get('step') || 'welcome';
        
        // Check if we need to clear cache
        const resetCache = urlParams.get('reset_cache');
        if (resetCache === 'true') {
            // Clear localStorage
            if (typeof localStorage !== 'undefined') {
                localStorage.removeItem('topppa_selected_widgets');
                localStorage.removeItem('topppa_selected_extensions');
            }
        }
        
        // Initialize data from PHP - only include active items
        if (typeof topppaWizardData !== 'undefined') {
            // Only include widgets that are active (is_active: true)
            topppaSelectedWidgets = [];
            if (topppaWizardData.widgets) {
                Object.keys(topppaWizardData.widgets).forEach(widgetId => {
                    if (topppaWizardData.widgets[widgetId].is_active) {
                        topppaSelectedWidgets.push(widgetId);
                    }
                });
            }
            
            // Only include extensions that are active (is_active: true)
            topppaSelectedExtensions = [];
            if (topppaWizardData.extensions) {
                Object.keys(topppaWizardData.extensions).forEach(extensionId => {
                    if (topppaWizardData.extensions[extensionId].is_active) {
                        topppaSelectedExtensions.push(extensionId);
                    }
                });
            }
        }
        
        // Update progress bar
        topppaUpdateProgressBar();
    }

    function topppaSetupEventListeners() {
        // Widget toggles
        $(document).on('change', '.topppa-widget-toggle', function() {
            const widgetId = $(this).data('widget');
            const isChecked = $(this).is(':checked');
            topppaToggleWidget(widgetId, isChecked);
        });

        // Extension toggles
        $(document).on('change', '.topppa-feature-toggle', function() {
            const extensionId = $(this).data('extension');
            const isChecked = $(this).is(':checked');
            topppaToggleExtension(extensionId, isChecked);
        });

        // Toggle track clicks (for visual toggle switches)
        $(document).on('click', '.topppa-toggle__track', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const $checkbox = $(this).siblings('.topppa-toggle__check');
            const isChecked = $checkbox.is(':checked');
            
            // Toggle the checkbox
            $checkbox.prop('checked', !isChecked).trigger('change');
        });

        // Read more button functionality
        $(document).on('click', '.topppa-read-more-btn', function() {
            const $btn = $(this);
            const $hiddenWidgets = $('.topppa-hidden-widget');
            const isShowingMore = $btn.data('show') === 'more';
            
            if (isShowingMore) {
                // Show all widgets with slow animation
                $btn.text('Loading...').prop('disabled', true);
                
                // Show all widgets at the same time with slow fade-in
                $hiddenWidgets.fadeIn(1500); // 1.5 seconds slow animation
                
                // Update button after animation completes
                setTimeout(function() {
                    $btn.text('Show Less Widgets').data('show', 'less').prop('disabled', false);
                }, 1500);
                
            } else {
                // Hide widgets after first 12
                $btn.text('Loading...').prop('disabled', true);
                
                // Hide all widgets at once
                $hiddenWidgets.fadeOut(800);
                
                setTimeout(function() {
                    $btn.text('Show More Widgets').data('show', 'more').prop('disabled', false);
                }, 800);
            }
        });

        // Enable/Disable all buttons
        $(document).on('click', '.topppa-enable-all', function() {
            topppaToggleAllItems('widget', true);
        });

        $(document).on('click', '.topppa-disable-all', function() {
            topppaToggleAllItems('widget', false);
        });

        // Navigation buttons
        $(document).on('click', '.topppa-next-button', function() {
            const nextStep = $(this).data('next');
            if (nextStep) {
                topppaNavigateToStep(nextStep);
            }
        });

        $(document).on('click', '.topppa-back-button', function() {
            const prevStep = $(this).data('prev');
            if (prevStep) {
                topppaNavigateToStep(prevStep);
            }
        });

        // Skip wizard
        $(document).on('click', '.topppa-skip-link', function(e) {
            e.preventDefault();
            topppaSkipWizard();
        });

        // Complete wizard
        $(document).on('click', '.topppa-complete-wizard', function() {
            topppaCompleteWizard();
        });
    }

    function topppaToggleWidget(widgetId, isChecked) {
        if (isChecked) {
            if (!topppaSelectedWidgets.includes(widgetId)) {
                topppaSelectedWidgets.push(widgetId);
            }
        } else {
            topppaSelectedWidgets = topppaSelectedWidgets.filter(id => id !== widgetId);
        }
        
        topppaSaveWidgetSelections();
        topppaUpdateWidgetCount();
    }

    function topppaToggleExtension(extensionId, isChecked) {
        if (isChecked) {
            if (!topppaSelectedExtensions.includes(extensionId)) {
                topppaSelectedExtensions.push(extensionId);
            }
        } else {
            topppaSelectedExtensions = topppaSelectedExtensions.filter(id => id !== extensionId);
        }
        
        topppaSaveExtensionSelections();
        topppaUpdateExtensionCount();
    }

    function topppaToggleAllItems(type, enable) {
        const selector = type === 'widget' ? '.topppa-widget-toggle' : '.topppa-feature-toggle';
        const items = $(selector);
        
        items.each(function() {
            const $checkbox = $(this);
            const isPro = $checkbox.closest('.topppa-item-widget, .topppa-item-feature').find('.topppa-pro-badge').length > 0;
            
            // Don't toggle PRO items if user doesn't have pro
            if (!isPro) {
                $checkbox.prop('checked', enable).trigger('change');
            }
        });
    }

    function topppaNavigateToStep(step) {
        if (topppaLoading) return;
        
        // Save current step data
        topppaSaveStepData();
        
        // Show loading
        topppaShowLoading();
        
        // Navigate to step
        const url = new URL(window.location);
        url.searchParams.set('step', step);
        window.location.href = url.toString();
    }

    function topppaSaveStepData() {
        // Save selections to localStorage
        localStorage.setItem('topppa_selected_widgets', JSON.stringify(topppaSelectedWidgets));
        localStorage.setItem('topppa_selected_extensions', JSON.stringify(topppaSelectedExtensions));
    }

    function topppaLoadSavedSelections() {
        // Load saved selections from localStorage
        const savedWidgets = localStorage.getItem('topppa_selected_widgets');
        const savedExtensions = localStorage.getItem('topppa_selected_extensions');
        
        // If no saved selections, use the defaults from PHP (already set in topppaInitializeWizard)
        if (savedWidgets) {
            topppaSelectedWidgets = JSON.parse(savedWidgets);
        }
        topppaUpdateWidgetCheckboxes();
        
        if (savedExtensions) {
            topppaSelectedExtensions = JSON.parse(savedExtensions);
        }
        topppaUpdateExtensionCheckboxes();
        
        topppaUpdateCounts();
    }

    function topppaUpdateWidgetCheckboxes() {
        $('.topppa-widget-toggle').each(function() {
            const widgetId = $(this).data('widget');
            $(this).prop('checked', topppaSelectedWidgets.includes(widgetId));
        });
    }

    function topppaUpdateExtensionCheckboxes() {
        $('.topppa-feature-toggle').each(function() {
            const extensionId = $(this).data('extension');
            $(this).prop('checked', topppaSelectedExtensions.includes(extensionId));
        });
    }

    function topppaUpdateCounts() {
        topppaUpdateWidgetCount();
        topppaUpdateExtensionCount();
    }

    function topppaUpdateWidgetCount() {
        const count = topppaSelectedWidgets.length;
        const total = $('.topppa-widget-toggle').length;
        $('.topppa-widget-count').text(`${count}/${total} widgets selected`);
    }

    function topppaUpdateExtensionCount() {
        const count = topppaSelectedExtensions.length;
        const total = $('.topppa-feature-toggle').length;
        $('.topppa-extension-count').text(`${count}/${total} extensions selected`);
    }

    function topppaSaveWidgetSelections() {
        localStorage.setItem('topppa_selected_widgets', JSON.stringify(topppaSelectedWidgets));
    }

    function topppaSaveExtensionSelections() {
        localStorage.setItem('topppa_selected_extensions', JSON.stringify(topppaSelectedExtensions));
    }

    function topppaSyncCheckboxesWithDefaults() {
        // Sync widget checkboxes with PHP defaults if no localStorage data exists
        if (!localStorage.getItem('topppa_selected_widgets') && typeof topppaWizardData !== 'undefined' && topppaWizardData.widgets) {
            $('.topppa-widget-toggle').each(function() {
                const widgetId = $(this).data('widget');
                const isActive = topppaWizardData.widgets[widgetId] && topppaWizardData.widgets[widgetId].is_active;
                $(this).prop('checked', isActive);
            });
        }
        
        // Sync extension checkboxes with PHP defaults if no localStorage data exists
        if (!localStorage.getItem('topppa_selected_extensions') && typeof topppaWizardData !== 'undefined' && topppaWizardData.extensions) {
            $('.topppa-feature-toggle').each(function() {
                const extensionId = $(this).data('extension');
                const isActive = topppaWizardData.extensions[extensionId] && topppaWizardData.extensions[extensionId].is_active;
                $(this).prop('checked', isActive);
            });
        }
        
        topppaUpdateCounts();
    }

    function topppaUpdateProgressBar() {
        const steps = ['welcome', 'widgets', 'features', 'bepro', 'congrats'];
        const currentIndex = steps.indexOf(topppaCurrentStep);
        
        $('.topppa-progress-step').each(function(index) {
            const $step = $(this);
            const $number = $step.find('.topppa-step-number');
            
            if (index < currentIndex) {
                $step.removeClass('active pending').addClass('completed');
                $number.text('✓');
            } else if (index === currentIndex) {
                $step.removeClass('completed pending').addClass('active');
                $number.text(index + 1);
            } else {
                $step.removeClass('active completed').addClass('pending');
                $number.text(index + 1);
            }
        });
    }

    function topppaCompleteWizard() {
        if (topppaLoading) return;
        
        topppaShowLoading();
        
        const currentSelectedWidgets = [];
        $('.topppa-widget-toggle:checked').each(function() {
            const widgetId = $(this).data('widget');
            if (widgetId) {
                currentSelectedWidgets.push(widgetId);
            }
        });
        
        const currentSelectedExtensions = [];
        $('.topppa-feature-toggle:checked').each(function() {
            const extensionId = $(this).data('extension');
            if (extensionId) {
                currentSelectedExtensions.push(extensionId);
            }
        });
        
        if (currentSelectedWidgets.length === 0) {
            currentSelectedWidgets.push(...topppaSelectedWidgets);
        }
        
        if (currentSelectedExtensions.length === 0) {
            currentSelectedExtensions.push(...topppaSelectedExtensions);
        }
        
        const data = {
            action: 'topper_pack_save_wizard_data',
            step: 'congrats',
            selected_widgets: currentSelectedWidgets,
            selected_extensions: currentSelectedExtensions,
            nonce: topppaWizardData.nonce
        };
        
        $.ajax({
            url: topppaWizardData.ajax_url,
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.success) {
                    window.location.href = topppaWizardData.dashboard_url;
                } else {
                    topppaHideLoading();
                    topppaShowMessage('Error completing wizard. Please try again.', 'error');
                }
            },
            error: function() {
                topppaHideLoading();
                topppaShowMessage('Network error. Please try again.', 'error');
            }
        });
    }

    function topppaSkipWizard() {
        if (topppaLoading) return;
        
        topppaShowLoading();
        
        // Send skip request using the same save action
        $.ajax({
            url: topppaWizardData.ajax_url,
            type: 'POST',
            data: {
                action: 'topper_pack_save_wizard_data',
                step: 'skip',
                selected_widgets: [],
                selected_extensions: [],
                nonce: topppaWizardData.nonce
            },
            success: function(response) {
                if (response.success) {
                    window.location.href = topppaWizardData.dashboard_url;
                } else {
                    topppaHideLoading();
                    topppaShowMessage('Error skipping wizard. Please try again.', 'error');
                }
            },
            error: function() {
                topppaHideLoading();
                topppaShowMessage('Network error. Please try again.', 'error');
            }
        });
    }

    function topppaShowLoading() {
        topppaLoading = true;
        $('.topppa-wizard-content').addClass('topppa-loading');
        $('.topppa-next-button, .topppa-back-button, .topppa-skip-link').prop('disabled', true);
    }

    function topppaHideLoading() {
        topppaLoading = false;
        $('.topppa-wizard-content').removeClass('topppa-loading');
        $('.topppa-next-button, .topppa-back-button, .topppa-skip-link').prop('disabled', false);
    }

    function topppaShowMessage(message, type = 'info') {
        const alertClass = type === 'error' ? 'error' : 'info';
        const alertHtml = `
            <div class="topppa-alert topppa-alert-${alertClass}" style="
                padding: 12px 16px;
                border-radius: 8px;
                margin: 15px 0;
                background: ${type === 'error' ? '#fef2f2' : '#f0f9ff'};
                color: ${type === 'error' ? '#dc2626' : '#0369a1'};
                border: 1px solid ${type === 'error' ? '#fecaca' : '#bae6fd'};
            ">
                ${message}
            </div>
        `;
        
        $('.topppa-wizard-content').prepend(alertHtml);
        
        // Auto remove after 5 seconds
        setTimeout(function() {
            $('.topppa-alert').fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    }

    // Expose functions globally for template use
    window.TopppaWizard = {
        navigateToStep: topppaNavigateToStep,
        completeWizard: topppaCompleteWizard,
        skipWizard: topppaSkipWizard,
        toggleWidget: topppaToggleWidget,
        toggleExtension: topppaToggleExtension
    };

})(jQuery); 