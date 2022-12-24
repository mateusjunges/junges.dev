<?php

use App\Modules\Documentation\Enums\RepositoryType;
use App\Modules\Documentation\Models\Repository;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->string('documentation_url')->after('description')->nullable();
            $table->integer('downloads')->default(0)->after('topics');
            $table->string('type')->nullable()->after('topics');
            $table->boolean('visible')->default(false)->after('topics');
            $table->boolean('highlighted')->default(false)->after('topics');
        });

        Repository::query()
            ->whereIn('name', [
                'laravel-kafka',
                'laravel-acl',
                'laravel-2fa',
                'laravel-invite-codes',
                'laravel-pix',
                'laravel-time-helpers',
                'trackable-jobs-for-laravel'
            ])
            ->update([
                'type' => RepositoryType::PACKAGE->value,
                'visible' => true
            ]);
    }

    public function down()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'highlighted',
                'visible'
            ]);
        });
    }
};
