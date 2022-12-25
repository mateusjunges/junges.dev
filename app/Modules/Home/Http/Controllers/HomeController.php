<?php

namespace App\Modules\Home\Http\Controllers;

use Illuminate\View\View;

class HomeController
{
    public function __invoke(): View
    {
        return view('welcome');
    }
}
