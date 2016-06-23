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

    mix.sass('main.scss')
        .exec('./jigsaw build ' + env, ['./source/*', './source/**/*', '!./source/_assets/**/*'])
        .browserSync({
            server: { baseDir: 'build_' + env },
            proxy: null,
            files: [ 'build_' + env + '/**/*' ]
        });

    mix.scripts([
        paths.bower + '/bootstrap/dist/js/bootstrap.js'
    ], 'build_' + env + '/js/other.js', './');

    mix.styles([
        paths.bower + '/bootstrap/dist/css/bootstrap.css',
        paths.bower + '/font-awesome/css/font-awesome.css'
    ], 'build_' + env + '/css/other.css', './');

    mix.copy(paths.bower + '/bootstrap/dist/fonts/*.*', 'build_' + env + '/fonts/')
        .copy(paths.bower + '/font-awesome/fonts/*.*', 'build_' + env + '/fonts/');

});
