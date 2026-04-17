(function ($) {
    'use strict';

    $(document).ready(function() {

        window.TopppaMegaContentHandler = {

            initEvents: function () {
                let _this = this;

                $('.topppa-live-editor-iframe-modal .eicon-close').on('click', this.closeModal);

                $(document).on('click', '.topppa-live-editor-iframe-modal', function (e) {
                    if ($(e.target).closest(".dialog-lightbox-widget-content").length < 1) {
                        _this.closeModal();
                    }
                });

                $('#topppa-megamenu-content .topppa-mega-menu-btn').on('click', function (e) {
                    _this.handleMegaContent(e);
                });
            },

            handleMegaContent: function (e) {
                var widgetId = window.TOPPPANavMenuSettings.currentItemId,
                    $modalContainer = $('.topppa-live-editor-iframe-modal'),
                    paIframe = $modalContainer.find("#topppa-live-editor-control-iframe"),
                    lightboxType = $modalContainer.find(".dialog-type-lightbox");

                $('.elementor-loader-wrapper').hide();
                lightboxType.show();
                $modalContainer.show();
                paIframe.css("z-index", "-1");

                $.ajax({
                    type: 'POST',
                    url: topppaMegaContent.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        action: 'handle_live_editor',
                        security: topppaMegaContent.nonce,
                        key: widgetId,
                    },
                    success: function (res) {
                        paIframe.attr("src", res.data.url);
                        paIframe.attr("data-topppa-temp-id", res.data.id);

                        window.TopppaMegaContentHandler.saveMegaContentId( res.data.id, widgetId );

                        paIframe.on("load", function () {
                            paIframe.show();
                            paIframe.css("z-index", "1");
                        });
                    },
                    error: function (err) {
                        // Handle AJAX errors silently
                    }
                });
            },

            saveMegaContentId: function ( tempID, itemID ) {

                $.ajax({
                    type: 'POST',
                    url: topppaMegaContent.ajaxurl,
                    dataType: 'JSON',
                    data: {
                        action: 'save_topppa_mega_item_content',
                        security: topppaMegaContent.nonce,
                        template_id: tempID,
                        menu_item_id: itemID
                    },
                    success: function (res) {
                        // Handle success silently or show user feedback
                    },
                    error: function (err) {
                        // Handle errors silently
                    }
                });
            },

            closeModal: function (inserted = false) {

                $('.topppa-live-editor-iframe-modal').css('display', 'none');

                if (!inserted) {
                    var tempId = $(".topppa-live-editor-iframe-modal #topppa-live-editor-control-iframe").attr('data-topppa-temp-id');

                    if (undefined !== tempId && '' !== tempId) {
                        window.TopppaMegaContentHandler.checkTempValidity(tempId);
                    }
                }

                // reset temp id/src attribute.
                $(".topppa-live-editor-iframe-modal #topppa-live-editor-control-iframe").attr({
                    'data-topppa-temp-id': '',
                    'src': ''
                });
            },

            checkTempValidity: function (tempID) {

                if ('' !== tempID) {
                    $.ajax({
                        type: 'POST',
                        url: topppaMegaContent.ajaxurl,
                        dataType: 'JSON',
                        data: {
                            action: 'check_temp_validity',
                            security: topppaMegaContent.nonce,
                            templateID: tempID,
                        },
                        success: function (res) {
                            // Handle success silently or show user feedback
                        },
                        error: function (err) {
                            // Handle errors silently
                        }
                    });
                }
            },
        };

        window.TopppaMegaContentHandler.initEvents();
    });

})(jQuery);