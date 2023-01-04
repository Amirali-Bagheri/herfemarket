const mix = require('laravel-mix');
// require('laravel-mix-purgecss');
// require('laravel-mix-bundle-analyzer');
// const CompressionPlugin = require('compression-webpack-plugin');

// if (!mix.inProduction()) {
//     mix.bundleAnalyzer();
// }

// require('laravel-mix-merge-manifest');
// mix.mergeManifest();

mix
    // .js('node_modules/jquery/dist/jquery.min.js',  'node_modules/bootstrap/dist/js/bootstrap.js', 'public/js')
    .js('resources/js/admin/admin.js', 'public/js')
    .js('resources/js/admin/libs/file-manager.js', 'public/js')
    // .vue({
    //     extractStyles: true,
    //     globalStyles: false
    // })
    // .js('resources/js/mobile/mobile.js', 'public/js')
    // .js('resources/js/site/cedarmaps.js', 'public/js')
    // .js('node_modules/leaflet.locatecontrol/dist/L.Control.Locate.min.js', 'public/js')
    // .extract([
    //     'jquery',
    //     'axios',
    // 'babel-polyfill',
    // 'lodash',
    // 'tether',
    // 'vue',
    // 'bootstrap-vue',
    // 'vuex',
    // 'vuex-localstorage',
    // ])
    // .js('resources/js/site/jquery-2.2.0.min.js', 'public/js/jquery-2.2.0.min.js')
    // .js('node_modules/icheck/icheck.min.js', 'public/js/icheck.min.js')
    // .js('resources/js/site/waypoints-sticky.min.js', 'public/js/waypoints-sticky.min.js')
    // .js('resources/js/site/isotope.pkgd.min.js', 'public/js/isotope.pkgd.min.js')
    // .js('resources/js/site/owl.carousel.min.js', 'public/js/owl.carousel.min.js')
    // .js('resources/js/site/magnific-popup.min.js', 'public/js/magnific-popup.min.js')
    // .js('resources/js/site/stellar.min.js', 'public/js/stellar.min.js')
    // .js('node_modules/kinetic/kinetic.min.js', 'public/js/kinetic.js')
    // .js('resources/js/site/jquery.final-countdown.js', 'public/js/jquery.final-countdown.js')
    // .js('resources/js/site/custom.js', 'public/js/custom.js')
    // .js('resources/js/site/waypoints.min.js', 'public/js/waypoints.min.js')

    // .sass('resources/sass/admin.scss', 'public/css')
    // .sass('resources/sass/admin/admin.scss', 'public/css/admin.css', [
    //     require('postcss-import'),
    //     require('tailwindcss'),
    //     // require("autoprefixer"),
    // ])

    // .sass('resources/sass/fonts.scss', 'public/css')
    // .sass('resources/sass/site.scss', 'public/css')
    // .sass('resources/sass/mobile/mobile.scss', 'public/css')

    .options({
        autoprefixer: false,
        // processCssUrls: false,
        // uglify: true
    })
// .webpackConfig({
//     plugins: [
//         new CompressionPlugin({
//             asset: '[path].gz[query]',
//             algorithm: 'gzip',
//             test: /\.js$|\.css$|\.html$|\.svg$/,
//             threshold: 10240,
//             minRatio: 0.8,
//         }),
//     ],
// })
// .version()
// .purgeCss()
;


// mix.minify('public/site.css');
mix.webpackConfig({
    optimization: {
        providedExports: false,
        sideEffects: false,
        usedExports: false
    },
    // resolve: {
    //     alias: {
    //         @: __dirname + '/resources/assets/js'
    //     },
    // },
});
// mix.copy('node_modules/icheck/skins/all.css', 'public/css/icheck.css');
// mix.options({
//     autoprefixer: {remove: false}
// });
mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});
mix.override((config) => {
    delete config.watchOptions;
});


//
// mix.scripts([
//     'resources/js/mobile/jquery.min.js',
//     'resources/js/mobile/bootstrap.bundle.min.js',
//     'resources/js/mobile/waypoints.min.js',
//     'resources/js/mobile/jquery.easing.min.js',
//     'resources/js/mobile/owl.carousel.min.js',
//     'resources/js/mobile/jquery.counterup.min.js',
//     'resources/js/mobile/jquery.countdown.min.js',
//     'resources/js/mobile/default/jquery.passwordstrength.js',
//     'resources/js/mobile/wow.min.js',
//     'resources/js/mobile/jarallax.min.js',
//     'resources/js/mobile/jarallax-video.min.js',
//     'resources/js/mobile/default/dark-mode-switch.js',
//     'resources/js/mobile/default/active.js',
//     'resources/js/mobile/custom.js',
//
// ], 'public/js/mobile.js');
// mix.webpackConfig({
//     watchOptions: {
//         aggregateTimeout: 2000,
//         poll: 2000,
//         ignored: /node_modules/
//     }
// });
