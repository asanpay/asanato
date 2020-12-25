const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

/*
 |--------------------------------------------------------------------------
 | Global Asset handling
 |--------------------------------------------------------------------------
 */
mix.copyDirectory ('resources/assets/vendors/vazir-font/fonts/', 'public/fonts/vazir')
mix.copyDirectory ('resources/assets/vendors/font-awesome/fonts/', 'public/fonts')

mix.styles ([
    'resources/assets/vendors/vazir-font/css/vazir-font.css',
    'resources/assets/vendors/font-awesome/css/font-awesome.css',
    'resources/assets/css/bootstrap-rtl.css',
    'resources/assets/css/rtl-patch.css',
    'resources/assets/css/vue-simple-spinner.css',
], 'public/css/global-rtl.css')

mix.copy ('resources/themes/simple/simple.css', 'public/css/')

/*
 |--------------------------------------------------------------------------
 | Darkness Theme
 |--------------------------------------------------------------------------
 */
mix.copyDirectory ('resources/themes/darkness/img/', 'public/darkness/img')
mix.styles ([
    'resources/themes/darkness/css/main.css',
], 'public/darkness/css/main.min.css')
mix.styles ([
    'resources/themes/darkness/css/main-rtl.css',
], 'public/darkness/css/main-rtl.min.css')
mix.scripts ([
    'resources/assets/vendors/font-awesome/js/fontawesome-all.js',
    'resources/themes/darkness/js/js-plugins/crum-mega-menu.js',
    'resources/themes/darkness/js/js-plugins/froala_editor.min.js',
    'resources/themes/darkness/js/js-plugins/imagesLoaded.js',
    'resources/themes/darkness/js/js-plugins/isotope.pkgd.min.js',
    'resources/themes/darkness/js/js-plugins/jquery.magnific-popup.js',
    'resources/themes/darkness/js/js-plugins/jquery.matchHeight.js',
    'resources/themes/darkness/js/js-plugins/leaflet.js',
    'resources/themes/darkness/js/js-plugins/MarkerClusterGroup.js',
    'resources/themes/darkness/js/js-plugins/select2.js',
    'resources/themes/darkness/js/js-plugins/smooth-scroll.js',
    'resources/themes/darkness/js/js-plugins/swiper.min.js',
    'resources/themes/darkness/js/js-plugins/TimeCircles.js',
    'resources/themes/darkness/js/js-plugins/ajax-pagination.js',
    'resources/themes/darkness/js/js-plugins/segment.js',
    'resources/themes/darkness/js/js-plugins/sticky-sidebar.js',
    'resources/themes/darkness/js/main.js'
], 'public/darkness/js/main.min.js')

if (mix.config.inProduction) {
    mix.version ()
}
