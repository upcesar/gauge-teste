const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

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

elixir(mix => {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    var flotPath = 'node_modules/flot';
    var jqueryPath = 'node_modules/jquery/dist';
    
    mix.sass('app.scss')
       .copy(bootstrapPath + '/fonts', 'public/fonts')
       .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/js')
       .copy(jqueryPath + '/jquery.min.js', 'public/js')
       .copy(flotPath + '/*.js', 'public/js/flot')
       .webpack('app.js')
       .webpack('flot/*.js');
       
});
