<?php

namespace App;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Class Server
 *
 * @property int $id
 * @property string $name
 * @property string $website
 * @property string $description
 * @property string $banner_url
 * @property double $episode
 * @property int $votes_count
 * @property int $clicks_count
 *
 * @property string $exp_group
 *
 * @property ServerConfig $config
 * @property ServerMode $mode
 * @property ServerReport $report
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $owner
 * @property ServerVote|HasMany $votes
 * @property ServerClick|HasMany $clicks
 *
 * @method static withCount(string $string)
 * @method static expGround(int $period, string $group)
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
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
     * A server has many monthly reports.
     *
     * @return HasMany
     */
    public function reports()
    {
        return $this->hasMany(ServerReport::class);
    }

    /**
     * A server has one monthly report. (current)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|\Illuminate\Database\Query\Builder
     */
    public function report()
    {
        return $this->hasOne(ServerReport::class);
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
     * Reset the vote and click counters of the server for this month.
     *
     * @return bool
     */
    public function resetCounters()
    {
        return $this->update(['clicks_count' => 0, 'votes_count' => 0]);
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

    /**
     * Exp group = The group of servers to work with [low-rate, mid-rate, high-rate]
     * Mode      = The server mode that we work with [renewal, classic, custom, pre-renewal]
     *
     * @param string $exp_group The group type [low-rate, mid-rate, high-rate]
     * @param string $mode The server mode [renewal, classic, custom, pre-renewal]
     * @param string $sort_column The column that should be sorted. [columns]
     * @param string $orderBy The order in which the result should be returned [desc, asc]
     *
     * @throws Exception
     *
     * @return Builder
     */
    public static function filter($exp_group = "all", $mode = "all", $sort_column = "any", $orderBy = 'desc')
    {
        $builder = self::query();

        if (in_array($mode, ['renewal', 'pre-renewal', 'classic', 'custom'])) {
            $builder->whereHas('mode', function(Builder $query) use ($mode) {
                $query->where('name', $mode);
            });
        }
        if (in_array($exp_group, ['low-rate', 'mid-rate', 'high-rate', 'custom', 'classic'])) {
            $builder->whereHas('config', function($query) use ($exp_group) {
                /** @var ServerConfig $query */
                $query->expGroup($exp_group);
            });
        }

        // TODO: Add checks for sort column and order by?

        return $builder->with('config')->orderBy($sort_column, $orderBy);
    }
}
