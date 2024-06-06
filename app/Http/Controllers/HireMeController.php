<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

final class HireMeController
{
    public function __invoke(): View
    {
        return view('front.hire-me');
    }
}
