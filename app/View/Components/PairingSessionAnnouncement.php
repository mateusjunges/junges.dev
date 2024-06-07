<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class PairingSessionAnnouncement extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.pairing-session-announcement');
    }
}
