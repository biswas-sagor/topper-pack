(function ($) {
    "use strict";

    $(document).ready(function () {

        if ($('.elementor-editor-active').length > 0) {
            return;
        }

        // Helper: Detect mobile device
        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        // ✅ Only initialize Lenis on NON-mobile
        if (!isMobile()) {

            // Lenis configuration for desktop
            const lenis = new Lenis({
                duration: 1,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                orientation: 'vertical',
                gestureOrientation: 'vertical',
                smoothWheel: true,
                wheelMultiplier: 1,
                smoothTouch: true,
                touchMultiplier: 1.5,
                infinite: false,
                lerp: 0.05,
                syncTouch: true,
                syncTouchLerp: 0.1,
                touchInertiaMultiplier: 10,
                normalizeWheel: true,
            });

            // RAF setup
            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);

            // Smooth scroll for anchor links
            $('a[href^="#"]').on('click', function (e) {
                e.preventDefault();
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    lenis.scrollTo(target[0], {
                        duration: 3.0,
                        easing: (t) => t * t * (3 - 2 * t),
                        offset: -80,
                        immediate: false
                    });
                }
            });

            // Prevent Lenis from hijacking scroll inside menu
            var menuSelector = '.topppa-mobile-menu-detached, .mobile-topppa-menu-area';
            function isInMenu(e) {
                return $(e.target).closest(menuSelector).length > 0;
            }

            $(document).on('wheel touchmove', function (e) {
                if (isInMenu(e)) {
                    lenis.stop();
                    e.stopPropagation();
                    return true;
                }
            });
        }

        // ✅ On mobile → do nothing (native scroll, no Lenis)
    });

})(jQuery);