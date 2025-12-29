(function($) {
    'use strict';

    // Primary Color
    wp.customize('cs_primary_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--cs-primary', to);
        });
    });

    // Secondary Color
    wp.customize('cs_secondary_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--cs-secondary', to);
        });
    });

    // Accent Color
    wp.customize('cs_accent_color', function(value) {
        value.bind(function(to) {
            $(':root').css('--cs-accent', to);
        });
    });

    // Font Size
    wp.customize('cs_font_size', function(value) {
        value.bind(function(to) {
            $('html').css('font-size', to + 'px');
        });
    });

})(jQuery);