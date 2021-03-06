<?php
/**
 * Created by PhpStorm.
 * User: markhester
 * Date: 17/01/2019
 * Time: 21:10
 */

namespace App\Interactions;

use App\Listings\Listing;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * Class Interaction
 *
 * @method static Collection byClientIp($ip_address)
 * @method Collection latestByCurrentClientIp()
 * @method Collection hasClientInteractedWith($hours)
 *
 * @property User $publisher
 *
 * @package App\Interactions
 */
abstract class Interaction extends Model
{
    /**
     * An interaction has many listing attached.
     *
     * This is because we use polymorphic many to many.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function listings()
    {
        return $this->morphToMany(Listing::class,'interaction');
    }

    /**
     * But we really only need the first listing, since we wont be
     * attaching more than one listing for each model.
     *
     * @return Listing
     */
    protected function getListingAttribute()
    {
        return $this->listings()->first();
    }

    /**
     * A review has a single publisher user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope votes to the current logged in IP Address
     * @param Builder $query
     * @param string $ip_address
     */
    public function scopeByClientIp(Builder $query, string $ip_address)
    {
        $query->where('ip_address', $ip_address);
    }

    /**
     * @param Builder $query
     */
    public function scopeLatestByCurrentClientIp(Builder $query)
    {
        $query->byClientIp(request()->getClientIp())->latest()->limit(1);
    }

    /**
     * Return boolean of weather the current client IP has interacted.
     *
     * @param Builder $query
     * @param int $hours
     * @return bool
     */
   public function scopeHasClientInteractedWith(Builder $query, int $hours)
   {
       return Carbon::now()->subHours($hours) <= $query->latestByCurrentClientIp()->pluck('created_at')->first();
   }
}