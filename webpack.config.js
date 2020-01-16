// This project uses "Yarn" package manager for managing JavaScript dependencies along
// with "Webpack Encore" library that helps working with the CSS and JavaScript files
// that are stored in the "assets/" directory.
//
// Read https://symfony.com/doc/current/frontend.html to learn more about how
// to manage CSS and JavaScript files in Symfony applications.
var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .autoProvideVariables({
        "jQuery.tagsinput": "bootstrap-tagsinput"
    })
    .enableSassLoader()
    // when versioning is enabled, each filename will include a hash that changes
    // whenever the contents of that file change. This allows you to use aggressive
    // caching strategies. Use Encore.isProduction() to enable it only for production.
    .enableVersioning(false)
    .addEntry('js/app', [
        './assets/js/app.js',
        './assets/js/sondage.js',
        //'./assets/js/chat.js',
        './assets/js/home.js',
        './assets/js/add-collection.js',
        './assets/js/calendar.js'
    ])
    .addEntry('js/sb-admin-2', './assets/js/sb-admin-2.js')
    //.addStyleEntry("css/app", ["./assets/scss/sb-admin-2.scss"])
    .splitEntryChunks()
    .enableSingleRuntimeChunk()
    .enableIntegrityHashes(Encore.isDev())
    .configureBabel(null, {
        useBuiltIns: 'usage',
        corejs: 3,
    })
;

module.exports = Encore.getWebpackConfig();
