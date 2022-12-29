<?php declare(strict_types=1);

namespace App\Modules\Advertising\View\Composers;
use App\Modules\Advertising\Models\Sponsor;
use Illuminate\Contracts\View\View;

final class SponsorsComposer
{
    public function compose(View $view): void
    {
        $sponsors = Sponsor::query()
            ->currentSponsoring()
            ->get();

        $view->with('sponsors', $sponsors);
    }
}
