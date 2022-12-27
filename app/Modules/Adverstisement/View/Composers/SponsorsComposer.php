<?php declare(strict_types=1);

namespace App\Modules\Adverstisement\View\Composers;

use App\Modules\Adverstisement\Models\Sponsor;
use Illuminate\View\View;

final class SponsorsComposer
{
    public function compose(View $view): void
    {
        /** @var \Illuminate\Support\Collection<Sponsor> $sponsors */
        $sponsors = Sponsor::query()->get();

        $view->with('sponsors', $sponsors);
    }
}
