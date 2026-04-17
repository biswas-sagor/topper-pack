(function ($) {
    'use strict';
    var poppinsfontLink = document.createElement('link');
    poppinsfontLink.rel = 'stylesheet';
    poppinsfontLink.href = 'https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
    poppinsfontLink.type = 'text/css';
    document.head.appendChild(poppinsfontLink);

    $(document).ready(function () {

        window.TOPPPANavMenuSettings = {

            itemsData: {},

            currentItemId: null,

            currenItemDepth: null,

            init: function () {
                this.initControls();
                this.addSettingsTriggers();
                this.initEvents();
            },

            initControls: function () {
                // Color Controls.
                $('#topppa-icon-color-field, #topppa-badge-color-field, #topppa-badge-bg-field').wpColorPicker();

                // Icon Picker.
                this.iconPicker = $('#topppa-icon-field').fontIconPicker({
                    source: TOPPPAIconsList,
                    hasSearch: true,
                    emptyIcon: true,
                });
            },

            addSettingsTriggers: function () {
                var _this = this,
                    pos = $('body').hasClass('rtl') ? 'right' : 'left';

                $('#menu-to-edit .menu-item').each(function () {

                    var itemTrigger = _this.getTriggerHtml(this);

                    $(this).addClass('topppa-mega-menu-item');
                    $(this).append(itemTrigger);

                    $(this).find('.topppa-mega-menu-item-settings').css(pos, $(this).find('.menu-item-handle').outerWidth() + 10 + 'px');
                });
            },

            initEvents: function () {
                var _this = this;

                $('.topppa-mega-menu-item-settings').on('click', function (e) {
                    _this.triggerSettingsPopup(_this, e);
                });

                $('#topppa-mega-menu-save').on('click', function () {
                    var $button = $(this);
                    _this.saveItemSettings(_this, $button);
                });

                $('.topppa-mega-menu-settings-modal .eicon-close').on('click', this.closeModal);

                $(document).on('click', '.topppa-mega-menu-settings-modal', function (e) {
                    if ($(e.target).closest(".dialog-lightbox-widget-content").length < 1) {
                        window.TOPPPANavMenuSettings.closeModal();
                    }
                });
            },

            triggerSettingsPopup: function (_this, e) {

                _this.currentItemId = $(e.target).data('id');
                _this.currenItemDepth = $(e.target).data('item-depth');

                _this.handlePopupControls(_this);

                $(".topppa-mega-menu-btn i").addClass("loader-hidden dashicons-admin-generic").removeClass("dashicons-yes");
                $(".topppa-mega-menu-btn span").text('Save Settings');

                // show depth-0 controls
                if (0 == _this.currenItemDepth) {
                    $('.topppa-setting-container.topppa-depth-0-control').removeClass('topppa-setting-hidden');
                }
                
            },

            handlePopupControls: function (_this) {

                if (_this.itemsData[_this.currentItemId]) {
                    _this.setControlsVal(_this.itemsData[_this.currentItemId]);

                } else {
                    $.ajax({
                        url: topppaMenuSettings.ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'get_topppa_menu_item_settings',
                            security: topppaMenuSettings.nonce,
                            item_id: _this.currentItemId
                        },
                        success: function (res) {
                            _this.itemsData[_this.currentItemId] = res.data;
                            _this.setControlsVal(res.data);
                        },
                        error: function(error) {
                            // Handle errors silently
                        }
                    });
                }
            },

            setControlsVal: function (settings) {

                var _this = this;

                if (settings) {

                    var isChecked = 'true' == settings.mega_content_enabled ? true : false,
                        isFullWidth = 'true' == settings.full_width_mega_content ? true : false;

                    $('#topppa-megamenu-icon-type').val(settings.item_icon_type)
                    _this.iconPicker.val(settings.item_icon);
                    _this.iconPicker.refreshPicker();
                    $('#topppa-lottie-url').val(settings.item_lottie_url);
                    $('#topppa-badge-text-field').val(settings.item_badge);
                    $('#topppa-badge-bg-field').wpColorPicker("color", settings.item_badge_bg);
                    $('#topppa-megamenu-position').val(settings.mega_content_pos);
                    $('#topppa-icon-color-field').wpColorPicker("color", settings.item_icon_color);
                    $('#topppa-badge-color-field').wpColorPicker("color", settings.item_badge_color);
                    $('#topppa-mega-content-width').val(settings.mega_content_width.replace('px', ''));
                    $('#topppa-megamenu-switcher input').prop('checked', isChecked);
                    $('#topppa-full-width-switcher input').prop('checked', isFullWidth);

                } else {
                    $('#topppa-megamenu-icon-type').val('icon');
                    _this.iconPicker.val('');
                    _this.iconPicker.refreshPicker();
                    $('#topppa-lottie-url').val('');
                    $('#topppa-badge-text-field').val('');
                    $('#topppa-badge-bg-field').wpColorPicker("color", '#0E59F2');
                    $('#topppa-megamenu-position').val('default');
                    $('#topppa-icon-color-field').wpColorPicker("color", '#0E59F2');
                    $('#topppa-badge-color-field').wpColorPicker("color", '#bada55');
                    $('#topppa-mega-content-width').val('');
                    $('#topppa-megamenu-switcher input').prop('checked', false);
                    $('#topppa-full-width-switcher input').prop('checked', false);
                }

                this.checkIconType();

                $("#topppa-megamenu-icon-type").on('change', function () {
                    _this.checkIconType();
                });

                $('#elementor-template-nav-menu-modal-container').show();
            },

            checkIconType: function () {

                if ('icon' === $("#topppa-megamenu-icon-type").val()) {
                    $(".topppa-lottie-settings").addClass("topppa-setting-hidden");
                    $(".topppa-icon-settings").removeClass("topppa-setting-hidden");
                } else {
                    $(".topppa-lottie-settings").removeClass("topppa-setting-hidden");
                    $(".topppa-icon-settings").addClass("topppa-setting-hidden");
                }

            },
            saveItemSettings: function (_this, $btn) {

                var $btnIcon = $btn.find("i");
                if (!$btnIcon.hasClass("loader-hidden"))
                    return;

                $btnIcon.addClass("loading").removeClass("loader-hidden");

                var itemSettings = {
                    item_id: _this.currentItemId,
                    item_depth: _this.currenItemDepth,
                    item_icon_type: $('#topppa-megamenu-icon-type').val(),
                    item_icon: $('#topppa-icon-field').val(),
                    item_lottie_url: $('#topppa-lottie-url').val(),
                    item_badge: $('#topppa-badge-text-field').val(),
                    item_badge_bg: $('#topppa-badge-bg-field').val(),
                    mega_content_pos: $('#topppa-megamenu-position').val(),
                    item_icon_color: $('#topppa-icon-color-field').val(),
                    item_badge_color: $('#topppa-badge-color-field').val(),
                    mega_content_enabled: $('#topppa-megamenu-switcher input').prop('checked'),
                    full_width_mega_content: $('#topppa-full-width-switcher input').prop('checked'),
                    mega_content_width: '' === $('#topppa-mega-content-width').val() ? '1170px' : $('#topppa-mega-content-width').val() + 'px',
                };

                _this.itemsData[_this.currentItemId] = itemSettings;

                $.ajax({
                    url: topppaMenuSettings.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'save_topppa_menu_item_settings',
                        security: topppaMenuSettings.nonce,
                        settings: itemSettings
                    },
                    success: function (res) {
                        $btnIcon.removeClass("loading dashicons-admin-generic").addClass("dashicons-yes");

                        $btn.find("span").text('Settings Saved');

                        setTimeout(function () {
                            $btnIcon.addClass("loader-hidden dashicons-admin-generic").removeClass("dashicons-yes");
                            $btn.find("span").text('Save Settings');
                        }, 2000);
                    },
                    error: function(error) {
                        // Handle errors silently
                    }
                });
            },

            closeModal: function () {
                $('#elementor-template-nav-menu-modal-container').hide();

                // hide depth-0 controls
                $('.topppa-setting-container.topppa-depth-0-control').addClass('topppa-setting-hidden');
            },

            getItemId: function ($item) {
                var id = $($item).attr('id').replace('menu-item-', '');

                return id;
            },

            getItemDepth: function ($item) {
                var depth = $($item).attr('class').match(/menu-item-depth-\d/);

                if (depth.length) {
                    return depth[0].replace('menu-item-depth-', '');
                } else {
                    return 0;
                }
            },

            getTriggerHtml: function ($item) {
                var itemId = this.getItemId($item),
                    itemDepth = this.getItemDepth($item);

                return '<span class="topppa-mega-menu-item-settings" data-id="' + itemId + '" data-item-depth="' + itemDepth + '">TOPPPA Mega Menu</span>';

            },
        }
        window.TOPPPANavMenuSettings.init();
    });

})(jQuery);