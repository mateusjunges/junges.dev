<?php declare(strict_types=1);

namespace App\Http\ViewComposers;

use Illuminate\View\View;

final class LazyViewComposer
{
    public function compose(View $view): void
    {
        $view->with('usesInternetExplorer', $this->usesInternetExplorer());
    }

    private function usesInternetExplorer(): bool
    {
        if (app()->runningInConsole()) {
            return false;
        }

        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        if (preg_match('~MSIE|Internet Explorer~i', $userAgent)) {
            return true;
        }

        if (str_contains($userAgent, 'Trident/7.0; rv:11.0')) {
            return true;
        }

        return false;
    }
}
