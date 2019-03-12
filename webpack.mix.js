const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        tailwindcss('./tailwind.js')
    ])
    .js('resources/employer/js/app.js', 'public/employer/js')
    .postCss('resources/employer/css/app.css', 'public/employer/css', [
        tailwindcss('./tailwind.js')
    ])
    .version();

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'vue$' : 'vue/dist/vue.esm.js',
            '@': __dirname + '/resources/js',
            '@/employer/': __dirname + '/resources/employer/js'
        }
    }
})
