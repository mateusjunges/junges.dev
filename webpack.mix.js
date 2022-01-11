const mix = require('laravel-mix');

mix.js("resources/js/app.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
        require("tailwindcss"),
    ]);

mix.copy("resources/js/alpine.js", "public/js/alpine.js")
