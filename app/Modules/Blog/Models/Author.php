<?php

namespace App\Modules\Blog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Author extends Model
{
    use HasFactory;

    /** @var string $table */
    protected $table = 'blog__authors';
}
