<?php

namespace App\Repositories\Reply;

use Illuminate\Http\Request;

interface IReplyRepository
{
    public function saveReply(Request $request);

    public function getAll();

    public function getRepliesForTicket($ticketID);

}
