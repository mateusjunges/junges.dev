<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class OpenSourceController
{
    public function __invoke(): View
    {
        return view('open-source');
    }
}
