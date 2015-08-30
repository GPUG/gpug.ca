var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    bootstrap: 'node_modules/bootstrap-sass/assets',
    jquery: 'node_modules/jquery/dist'
};

elixir(function(mix) {
    mix.sass(['app.scss', 'fonts'])
        .copy(paths.bootstrap + '/javascripts/bootstrap.min.js', 'public/js')
        .copy(paths.bootstrap + '/fonts', 'public/fonts')
        .copy(paths.jquery + '/jquery.min.*', 'public/js');
});
