<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var
     */
    protected $table = 'ticket';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

    ];

    public function replies()
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }

}
