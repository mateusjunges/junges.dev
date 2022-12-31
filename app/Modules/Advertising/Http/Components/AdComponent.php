<?php

namespace App\Modules\Advertising\Http\Components;

use App\Modules\Advertising\Models\Ad;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class AdComponent extends Component
{
    public function render(): View
    {
        $ad = Ad::getForCurrentPage();

        return view('front.components.ad', ['ad' => $ad]);
    }
}
