<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{

    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var
     */
    protected $table = 'ticket_reply';

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


   public function ticket()
   {
       return $this->belongsTo(Ticket::class)->withTrashed();
   }

}
