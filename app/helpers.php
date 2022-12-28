<?php

use Illuminate\Support\HtmlString;
use Faker\Factory;
use Faker\Generator;

if (! function_exists('faker'))
{
    function faker(): Generator
    {
        return Factory::create();
    }
}

if (! function_exists('__svg')) {
    function __svg($filename): HtmlString
    {
        return new HtmlString(
            file_get_contents(resource_path("svg/{$filename}.svg"))
        );
    }
}

