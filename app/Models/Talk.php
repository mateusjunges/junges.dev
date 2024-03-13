<?php

namespace App\Models;

use App\Models\Presenters\TalkPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Talk extends Model
{
    use HasFactory;
    use TalkPresenter;

    protected $casts = [
        'presented_at' => 'datetime',
    ];
}
