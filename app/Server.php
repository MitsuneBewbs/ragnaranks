<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Server
 *
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $description
 * @property string $banner_url
 * @property double $episode
 *
 * @property string $exp_group
 *
 * @property ServerConfig $config
 * @property ServerMode $mode
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $owner
 * @property ServerVote|HasMany $votes
 * @property ServerClick|HasMany $clicks
 *
 * @method static withCount(string $string)
 * @method $this statistics(int $period)
 * @method $this expGround(int $period, string $group)
 *
 *
 * @package App
 */
class Server extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['config'];

    /**
     * Scope a query to only include popular users.
     *
     * @param int $period
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatistics($query, int $period)
    {
        return $query->withCount([
            'votes' => function($query) use ($period){
                $query->where('created_at', '>', now()->subDay($period));
            },
            'clicks' => function($query) use ($period){
                $query->where('created_at', '>', now()->subDay($period));
            },
        ]);
    }

    /**
     * A server has one configuration set.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function config()
    {
        return $this->hasOne(ServerConfig::class, 'server_id', 'id');
    }

    /**
     * A server has one available mode.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mode()
    {
        return $this->hasOne(ServerMode::class, 'id', 'mode_id');
    }

    /**
     * A server can have many clicks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clicks()
    {
        return $this->hasMany(ServerClick::class, 'server_id', 'id');
    }

    /**
     * A server can have many votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(ServerVote::class,'server_id', 'id');
    }

    /**
     * A server belongs to a single owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Order the servers by their count of votes.
     *
     * @param int $period
     * @param string $orderBy
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filterVotes(int $period, string $orderBy)
    {
        return self::statistics($period)->orderBy('votes_count', $orderBy);
    }

    /**
     * Order the servers by their count of votes.
     *
     * @param int $period
     *
     * @param string $orderBy
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filterClicks(int $period, string $orderBy)
    {
        return self::statistics($period)->orderBy('clicks_count', $orderBy);
    }

    /**
     * Return the servers in an order, by their creation date.
     *
     * @param string $orderBy
     * @param int $period
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function orderedCreation(int $period, string $orderBy)
    {
        return self::statistics($period)->orderBy('created_at', $orderBy);
    }

    /**
     * Return the servers in order by their episode versions.
     *
     * @param string $orderBy
     * @param int $period
     *
     * @return Builder
     */
    public static function orderedEpisode(int $period, string $orderBy)
    {
        return self::statistics($period)->orderBy('episode', $orderBy);
    }

    /**
     * @param string $exp_group
     * @param int $period
     * @param string $orderBy
     * @return mixed
     */
    public static function filterExpGroup(string $exp_group, int $period, string $orderBy)
    {
        return self::statistics($period)->whereHas('config', function ($query) use ($exp_group) {
            $query->expGroup($exp_group);
        })->orderBy('votes_count', $orderBy);
    }

    /**
     * Get the EXP group that the server belongs to.
     *
     * @return string
     * @throws \Exception
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function getExpGroupAttribute()
    {
        if ($this->config->base_exp_rate <= config('filter.exp.low-rate.max'))
            return 'Low Rate';
        if ($this->config->base_exp_rate <= config('filter.exp.mid-rate.max'))
            return 'Mid Rate';
        if ($this->config->base_exp_rate <= config('filter.exp.high-rate.max'))
            return 'High Rate';

        throw new \Exception("Bad configuration for exp group Attribute");
    }
}
