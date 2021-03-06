<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tags
 *
 * @property int $id
 * @property string $tag
 * @property string $name
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @package App
 */
class Tag extends Model
{

    /**
     * Disable updated_at column
     */
    const UPDATED_AT = null;

    /**
     * The servers that belongs to this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function servers()
    {
        return $this->belongsToMany('App\Listing', 'servers_tags');
    }
}
