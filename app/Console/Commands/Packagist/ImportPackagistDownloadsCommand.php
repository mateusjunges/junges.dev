<?php

namespace App\Console\Commands\Packagist;

use App\Models\Repository;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Spatie\Packagist\PackagistClient;
use Spatie\Packagist\PackagistUrlGenerator;

class ImportPackagistDownloadsCommand extends Command
{
    protected $signature = 'import:packagist-downloads';

    protected $description = 'Import download counts of packages.';

    public function handle()
    {
        $this->info('Importing downloads from Packagist...');

        $client = new Client();
        $generator = new PackagistUrlGenerator();

        $packagist = new PackagistClient($client, $generator);

        collect($packagist->getPackagesNamesByVendor('mateusjunges')['packageNames'])
            ->map(function (string $packageName) use ($packagist) {
                return $packagist->getPackage($packageName)['package'];
            })
            ->each(function (array $package): void {
                $name = explode('/', $package['name'])[1];

                $this->comment("Fetching downloads for `{$name}`");

                $downloadCount = $package['downloads']['total'];

                Repository::query()->where('name', $name)->update(['downloads' => $downloadCount]);
            });

        $this->info('All done!');
    }
}
