<?php

namespace App\Repositories\Reply;

use Illuminate\Http\Request;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Log;

class ReplyRepository implements IReplyRepository
{
    private $reply;

    public function __construct(TicketReply $reply)
    {
        $this->reply = $reply;
    }

    public function saveReply(Request $request)
    {
        log::info($request->input());
        $reply = new $this->reply;
        $reply->reply = $request->input('tckt_reply');
        $reply->ticket_id = $request->input('ticket_id');
        $reply->actioned_date = date('Y-m-d');
        $reply->actioned_user = Auth::User()->id;
        $reply->save();

        return $reply->id;

    }

    public function getAll()
    {
        return $this->reply->all();
    }

    public function getRepliesForTicket($ticketID)
    {
        $data = $this->reply->where('ticket_id', $ticketID)
            ->orderBy('actioned_date', 'DESC')
            ->get();

        return $data;
    }

}
