<?php

namespace App\Models;

use App\Models\Presenters\TalkPresenter;
use Illuminate\Database\Eloquent\Model;

final class Talk extends Model
{
    use TalkPresenter;

    protected function casts(): array
    {
        return [
            'presented_at' => 'datetime',
        ];
    }
}
