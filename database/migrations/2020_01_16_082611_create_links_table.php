<?php

use App\Modules\Blog\Models\Link;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog__links', function (Blueprint $table) {
            $table->id();
            $table->boolean('approved')->default(false);
            $table
                ->foreignIdFor(\App\Modules\Auth\Models\User::class, 'user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->string('title');
            $table->string('slug');
            $table->longText('text')->nullable();
            $table->text('url');

            $table->string('status')->default(Link::STATUS_SUBMITTED);
            $table->timestamp('publish_date')->nullable()->default(null);

            $table->timestamps();
        });
    }
};
