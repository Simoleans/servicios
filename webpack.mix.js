const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js(['resources/js/app.js'], 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]).browserSync({
        open: 'external',
        proxy: 'localhost/jetstream/public',
        files: ['resources/views/**/*.php', 'app/**/*.php', 'routes/**/*.php', 'public/js/*.js', 'public/css/*.css']
    });

    // mix().browserSync({
    //     'proxy': 'tuapp.test',
    // });

    // mix.scripts([
    //     'public/js/alpine.js',
    // ], 'public/js/app.js');

// mix.combine([
//     'public/js/mercadopago-function.js',
// ], 'public/js/app.js');
