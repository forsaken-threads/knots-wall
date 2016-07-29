var gulp = require('gulp');
var elixir = require('laravel-elixir');
var argv = require('yargs').argv;

// Asset Component Paths
var paths = {
    'bower': 'vendor/bower_components',
    'assets': 'source/_assets',
    'compiled': 'source/_assets/_compiled'
};

elixir.config.assetsPath = 'source/_assets';
elixir.config.publicPath = 'source';

elixir(function(mix) {
    var env = argv.e || argv.env || 'local';

    mix
        .scripts([
            paths.compiled + '/pre/**/*.js'
        ], paths.compiled + '/post/app.js', './')
        .browserify(paths.compiled + '/post/app.js', 'source/js/app.js', './')
        .scripts([
            paths.bower + '/vue/dist/vue.js',
            paths.bower + '/jquery/dist/jquery.js',
            paths.bower + '/bootstrap/dist/js/bootstrap.js',
            paths.bower + '/js-cookie/src/js.cookie.js',
            paths.assets + '/js/**/*.js'
        ], 'source/js/main.js', './')
        .less('knotswall.less', 'source/_assets/css/knotswall.css', {
            paths: paths.bower + '/bootstrap/less'
        })
        .styles([
            paths.bower + '/font-awesome/css/font-awesome.css',
            paths.assets + '/css/**/*.css'
        ], 'source/css/app.css', './')
        .copy(paths.bower + '/bootstrap/dist/fonts/*.*', 'source/fonts/')
        .copy(paths.bower + '/font-awesome/fonts/*.*', 'source/fonts/')
        .exec('./jigsaw build ' + env, ['./source/*', './source/**/*', '!./source/_assets/**/*'])
        .exec('rsync -cvr ~/Projects/knots-wall/build_local/ redrover@spartang.com:/var/www/knotswall/jigsaw')
        .browserSync({
            server: { baseDir: 'build_' + env },
            proxy: null,
            files: [ 'build_' + env + '/**/*' ]
        });

});
