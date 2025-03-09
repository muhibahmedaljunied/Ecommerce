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
 mix.setPublicPath("/");
// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');



mix.js(
    [
        "resources/js/app.js",
    ],

    "js/app.js"
)
    // .sass("resources/sass/app.scss", "css");
    .styles(
        [
            // -----------------------------------------------------------------------------------------------------------------------------
            // "assets/css/custom-search.css",
            "assets/css/jstree.css",
            // "assets/css/jquery-ui.min.css",
            // "assets/css/estilos_factura.css",
            "assets/plugins/mscrollbar/jquery.mCustomScrollbar.css",
            "assets/plugins/sidebar/sidebar.css",
            "assets/css-rtl/sidemenu.css",
            "assets/css-rtl/style.css",
            "assets/css-rtl/style-dark.css",
            "assets/css-rtl/skin-modes.css",
            // "assets/bootstrap/css/bootstrap.min.css",
        ],
        "css/app.css"
    );


