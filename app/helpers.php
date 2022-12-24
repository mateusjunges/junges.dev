<?php

use Illuminate\Support\HtmlString;

if (! function_exists('__svg')) {
    function __svg($filename): HtmlString
    {
        return new HtmlString(
            file_get_contents(resource_path("svg/{$filename}.svg"))
        );
    }
}
