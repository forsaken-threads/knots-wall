var gulp = require('gulp');
var elixir = require('laravel-elixir');
var argv = require('yargs').argv;

// Asset Component Paths
var paths = {
    'bower': 'vendor/bower_components',
    'assets': 'source/_assets'
};

elixir.config.assetsPath = 'source/_assets';
elixir.config.publicPath = 'source';

elixir(function(mix) {
    var env = argv.e || argv.env || 'local';

    mix
        .scripts([
            paths.bower + '/bootstrap/dist/js/bootstrap.js'
        ], 'source/js/other.js', './')
        .styles([
            paths.bower + '/bootstrap/dist/css/bootstrap.css',
            paths.bower + '/font-awesome/css/font-awesome.css'
        ], 'source/css/other.css', './')
        .copy(paths.bower + '/bootstrap/dist/fonts/*.*', 'source/fonts/')
        .copy(paths.bower + '/font-awesome/fonts/*.*', 'source/fonts/')
        .sass('main.scss')
        .exec('./jigsaw build ' + env, ['./source/*', './source/**/*', '!./source/_assets/**/*'])
        .browserSync({
            server: { baseDir: 'build_' + env },
            proxy: null,
            files: [ 'build_' + env + '/**/*' ]
        });

});
