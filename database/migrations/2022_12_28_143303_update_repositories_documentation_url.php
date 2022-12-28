<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        (new \App\Modules\Docs\Actions\UpdateRepositoriesDocumentationUrl())();
    }
};
