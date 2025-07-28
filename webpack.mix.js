const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.sass('resources/scss/material-dashboard.scss', 'public/css');
mix.sass('resources/scss/custom-datatables.scss', 'public/css');
mix.js('resources/js/app.js', 'public/js');

mix.webpackConfig({
    plugins: [
        new BrowserSyncPlugin({
            proxy: 'http://127.0.0.1:8000', // ganti sesuai host lokal Laravel kamu
            files: [
                'app/**/*.php',
                'resources/views/**/*.php',
                'resources/views/**/**/*.php',
                'resources/scss/**/*.scss',
                'resources/js/**/*.js',
                'public/css/**/*.css',
                'public/js/**/*.js'
            ],
            open: false,
            reloadDelay: 500
        })
    ]
});