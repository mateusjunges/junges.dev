<?php declare(strict_types=1);

namespace Tests\Unit\Modules\Advertising\Models;

use App\Modules\Advertising\Models\Ad;
use Illuminate\Support\Carbon;
use Tests\Factories\AdFactory;
use Tests\TestCase;

/** @covers \App\Modules\Advertising\Models\Ad */
final class AdTest extends TestCase
{
    /** @test */
    public function it_will_not_show_ads_scheduled_for_the_future(): void
    {
        Carbon::setTestNow('2019-01-01 00:00:00');
        $this->createAd(2022, 12);

        $pageAd = Ad::getForPage();

        $this->assertNull($pageAd);
    }

    /** @test */
    public function it_can_get_ads_for_current_date(): void
    {
        Ad::query()->truncate();
        Carbon::setTestNow('2022-12-01 00:00:01');
        $expectedAd = $this->createAd(2022, 12);

        $ad = Ad::getForPage();

        $this->assertEquals($expectedAd->id, $ad->id);
    }

    /** @test */
    public function it_can_get_page_specific_ads(): void
    {
        Ad::query()->truncate();
        Carbon::setTestNow('2021-11-01 00:00:01');
        $expectedAd = $this->createAd(2021, 11, [
            'display_on_url' => 'test-page',
        ]);

        $ad = Ad::getForPage('test-page');

        $this->assertEquals($expectedAd->id, $ad->id);
    }

    /** @test */
    public function url_specific_ads_have_precedence_over_site_wide_ads(): void
    {
        Ad::query()->truncate();
        Carbon::setTestNow('2020-02-01 00:00:01');
        $siteWideAd = $this->createAd(2020, 2);
        $expectedAd = $this->createAd(2020, 2, [
            'display_on_url' => 'test-page',
        ]);

        $ad = Ad::getForPage('test-page');
        $anotherUrl = Ad::getForPage();

        $this->assertEquals($expectedAd->id, $ad->id);
        $this->assertEquals($siteWideAd->id, $anotherUrl->id);
    }

    private function createAd(int $year, int $month, array $attributes = []): Ad
    {
        $startsAt = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endsAt = $startsAt->copy()->endOfMonth();

        $defaultAttributes = [
            'display_on_url' => null,
            'starts_at' => $startsAt->format('Y-m-d'),
            'ends_at' => $endsAt->format('Y-m-d'),
        ];

        $attributes = array_merge($defaultAttributes, $attributes);

        return (new AdFactory())->createOne($attributes);
    }
}
