<?php

namespace App\Listings;

use App\Click;
use App\Mode;
use App\Tag;
use App\User;
use App\Vote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Listings
 *
 * @property int $rank
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $website
 * @property string $description
 * @property string $banner_url
 * @property double $episode
 * @property array $configs
 * @property array $statistics
 * @property Mode $mode
 * @property string $expRateTitle
 *
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user
 * @property Collection tags
 * @property Vote|HasMany $votes
 * @property Click|HasMany $clicks
 *
 * @package App
 */
class Listing extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'configs' => 'array',
        'statistics' => 'array',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * A server has one available mode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode()
    {
        return $this->hasOne(Mode::class, 'id', 'mode_id');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Vote
     */
    public function votes()
    {
        return $this->morphedByMany('App\Vote', 'interaction');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany|Vote
     *
     */
    public function clicks()
    {
        return $this->morphedByMany('App\Click', 'interaction');
    }

    /**
     * A server belongs to a single owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to this server.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ListingFilter($models);
    }

    /**
     * Get the EXP group that the server belongs to.
     *
     * @return string
     */
    public function getExpRateTitleAttribute()
    {
        $server_base = $this->configs['base_exp_rate'];

        if ($server_base <= config('filter.exp.low-rate.max'))
            return 'Low Rate';
        if ($server_base <= config('filter.exp.mid-rate.max'))
            return 'Mid Rate';
        if ($server_base <= config('filter.exp.high-rate.max'))
            return 'High Rate';

        return "Super High Rate";
    }
}
