<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        (new \App\Modules\Docs\Actions\UpdateRepositoriesDocumentationUrl())();
    }
};
