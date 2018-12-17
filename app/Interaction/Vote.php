<?php

namespace App\Interaction;

use App\Server;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vote
 *
 * @property int $id
 * @property string $ip_address
 * @property int $server_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Server $server
 *
 * @package App
 */
class Vote extends Model
{
    /**
     * Allows the calculation of the daily trend of votes.
     */
    use CalculateDailyTrend;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servers_votes';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * The vote belongs to a server.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id', 'id');
    }
}
