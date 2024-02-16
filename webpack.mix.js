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
mix.js('resources/js/reports/agency_sale/agency_sale.js', 'assets/js/agency_sale.js')
mix.js('resources/js/reports/client/client.js', 'assets/js/client.js')
mix.js('resources/js/reports/dvr/dvr.js', 'assets/js/dvr.js')
mix.js('resources/js/reports/kpi/kpi.js', 'assets/js/kpi.js')
mix.js('resources/js/reports/sales/sales.js', 'assets/js/sales.js')
mix.js('resources/js/reports/rider/rider.js', 'assets/js/rider.js')
mix.js('resources/js/reports/staff/staff.js', 'assets/js/staff.js')
mix.js('resources/js/reports/perfomance/perfomance.js', 'assets/js/perfomance.js')
mix.js('resources/js/reports/listing/listing.js', 'assets/js/listing.js')
mix.js('resources/js/reports/kpi/city_wise.js', 'assets/js/city_wise.js')
mix.js('resources/js/reports/kpi/consolidated.js', 'assets/js/consolidated.js')
mix.js('resources/js/reports/payment/payment.js', 'assets/js/payment.js')
mix.js('resources/js/reports/packages/packages.js', 'assets/js/packages.js')
mix.js('resources/js/reports/penetration/penetration.js', 'assets/js/penetration.js')
mix.js('resources/js/reports/agency_profile/health/health.js', 'assets/js/agency_profile.js')
mix.js('resources/js/custom/dataTable/datatable.js', 'assets/js/mws_datatable.js');
mix.copy('resources/css/images/graana_sidebar.png', 'public/assets/css/images/graana_sidebar.png');
mix.copy('resources/css/images/no_image.png', 'public/assets/css/images/no_image.png');
// mix.copy('resources/css/sidebar_icons/settingIcon.svg', 'public/assets/css/icons/settingIcon.svg');
mix.js('resources/js/zone_vue.js','public/assets/js/zone_vue.js')
    .vue();

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