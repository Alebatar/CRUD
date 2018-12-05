let mix = require('laravel-mix');

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

mix.js(['resources/assets/js/app.js','resources/assets/js/bootstrap.js','resources/assets/js/bootstrap.bundle.js','resources/assets/js/external/jquery/jquery.js',
        'resources/assets/js/external/jquery/jquery-ui.js'], 'public/js')
   .css(['resources/assets/css/bootstrap.css','resources/assets/css/jquery-ui.css','resources/assets/css/jquery-ui.theme.css'], 'public/css/app.css')
   .sass('resources/assets/sass/app.scss', 'public/css');
