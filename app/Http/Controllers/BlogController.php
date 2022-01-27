<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class BlogController
{
    public function index(): View
    {
        return view('blog.index');
    }
}
