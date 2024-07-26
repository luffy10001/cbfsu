const mix = require('laravel-mix');
require('laravel-mix-serve');
const lodash = require("lodash");
const WebpackRTLPlugin = require('webpack-rtl-plugin');
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

mix.sass('resources/css/guest.scss', "assets/css/guest.css").options({ processCssUrls: false });
mix.sass('resources/css/app.scss', "assets/css/app.css").options({ processCssUrls: false });
mix.js('resources/js/app.js', 'assets/js/app.js')
mix.js('resources/js/leaflet.js', 'assets/js/leaflet.js')
mix.js('resources/js/custom/dataTable/datatable.js', 'assets/js/mws_datatable.js');
mix.copy('resources/css/images/graana_sidebar.png', 'public/assets/css/images/graana_sidebar.png');
mix.copy('resources/css/images/no_image.png', 'public/assets/css/images/no_image.png');
mix.copy('resources/js/highstock.js', 'public/assets/js/highstock.js');
mix.copy('resources/js/jquery-ui.min.js', 'public/assets/js/jquery-ui.min.js');
mix.copy('resources/js/jquery.signature.js', 'public/assets/js/jquery.signature.js');


//images
mix.copy('resources/css/images/forgotPassword.png', 'public/assets/css/images/forgotPassword.png');
mix.copy('resources/css/images/login.png', 'public/assets/css/images/login.png');
mix.copy('resources/css/images/login-illustrator.png', 'public/assets/css/images/login-illustrator.png');
mix.copy('resources/css/images/LOGO.png', 'public/assets/css/images/LOGO.png');


mix.webpackConfig({
    plugins: [
        // ...
    ],
    resolve: {
        // ...
    },
    stats: {
        children: true
    }
});
/*
mix.css('https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css', "assets/css/responsive.dataTables.css");
mix.js('https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js', 'assets/js/responsive.dataTables.js');
*/
