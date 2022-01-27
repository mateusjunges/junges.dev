<?php

use Database\Seeders\UpdatesRepositoriesDocumentationUrl;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        (new UpdatesRepositoriesDocumentationUrl())->run();
    }
};
