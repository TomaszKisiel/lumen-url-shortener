require('laravel-mix-purgecss');

const mix = require('laravel-mix')

mix.setPublicPath('public')

mix.copyDirectory('resources/static', 'public/static')
mix.js('resources/js/app.js', 'js/app.js')
mix.sass( 'resources/sass/style.scss', 'css/style.css' )
    .purgeCss({
        content: [
            "app/**/*.php",
            "resources/**/*.html",
            "resources/**/*.js",
            "resources/**/*.jsx",
            "resources/**/*.ts",
            "resources/**/*.tsx",
            "resources/**/*.php",
            "resources/**/*.vue",
            "resources/**/*.twig",
            "vendor/illuminate/pagination/resources/views/bootstrap-4.blade.php"
        ],
    });

if ( ! mix.inProduction() ) {
    mix.browserSync( 'us.tkisiel.dev:8000' );
}
