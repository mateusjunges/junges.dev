<?php declare(strict_types=1);

namespace App\Modules\Adverstisement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id The sponsor identifier.
 * @property string $name The name of the sponsor.
 * @property string $website The sponsor website.
 * @property string $logo_url The URL to the sponsor logo.
 * @property \Illuminate\Support\Carbon $created_at The date and time the sponsor was created.
 * @property \Illuminate\Support\Carbon $updated_at The date and time the sponsor was last updated.
 * @property \Illuminate\Support\Carbon $deleted_at The date and time the sponsor was soft deleted.
 */
final class Sponsor extends Model
{
    use SoftDeletes;

    /** @var string $table */
    protected $table = 'advertisement__sponsors';

    protected $guarded = ['id'];

    public function getLogoUrl(): string
    {
        $storage = Storage::disk('sponsors');

        return $storage->url($this->logo);
    }
}
