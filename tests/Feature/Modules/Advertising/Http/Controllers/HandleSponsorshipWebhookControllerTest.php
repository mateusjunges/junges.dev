<?php declare(strict_types=1);

namespace Tests\Feature\Modules\Advertising\Http\Controllers;

use App\Modules\Advertising\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

final class HandleSponsorshipWebhookControllerTest extends TestCase
{
    /** @test */
    public function it_should_create_a_new_sponsor(): void
    {
        config()->set('services.github.should_verify_webhook_signature', false);

        Carbon::setTestNow('2022-12-30 00:24:00');
        $payload = $this->getPayload();
        $this->post(route('api.advertising.webhooks.github.sponsors'), json_decode($payload, true, 512, JSON_THROW_ON_ERROR), [
            'X-Hub-Signature' => "sha1=".hash_hmac('sha1', $payload, Str::repeat('a', 32))
        ]);

        $this->assertDatabaseHas(Sponsor::class, [
            'github_username' => 'typesense',
            'monthly_price_in_dollars' => 5,
            'started_sponsoring_at' => '2022-12-30 00:24:00',
        ]);
    }

    private function getPayload(): string
    {

        $now = now();

        return <<<JSON
{
  "action": "created",
  "sponsorship": {
    "id": 123456,
    "amount": 1000,
    "created_at": "{$now->format('Y-m-d\TH:i:s\Z')}",
    "sponsor": {
      "login": "typesense",
      "id": 12345,
      "name": "Typesense",
      "avatar_url": "https://avatars.githubusercontent.com/u/19822348?s=200&v=4",
      "": ""
    },
    "sponsorable": {
      "id": 12345,
      "login": "organization",
      "type": "Organization",
      "avatar_url": "https://avatars3.githubusercontent.com/u/12345?v=4",
      "html_url": "https://github.com/organization"
    },
    "tier": {
      "monthly_price_in_dollars": 5
    }
  },
  "sender": {
    "login": "octocat",
    "id": 12345,
    "avatar_url": "https://avatars3.githubusercontent.com/u/12345?v=4",
    "html_url": "https://github.com/octocat"
  }
}
JSON;
    }
}
