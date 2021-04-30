<?php

namespace App\Repositories\Ticket;

use Illuminate\Http\Request;

interface ITicketRepository
{
    public function saveTicket(Request $request);

    public function updateTicketStatus(Request $request);

    public function getAll();

    public function searchTicket(Request $request);

    public function getTicketDetails(Request $request);
}
