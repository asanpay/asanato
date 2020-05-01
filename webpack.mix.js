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
mix.copyDirectory ('resources/assets/vendors/vazir-font/fonts/', 'public/fonts/vazir') // copy vazir font

mix.styles ([
    'resources/assets/vendors/vazir-font/css/vazir-font.css',
    'resources/assets/css/bootstrap-rtl.css',
    'resources/assets/css/rtl-patch.css',
    'resources/assets/css/vue-simple-spinner.css',
], 'public/css/global-rtl.css')

if (mix.config.inProduction) {
    mix.version ()
}

mix.copy ('resources/themes/simple/simple.css', 'public/css/')
