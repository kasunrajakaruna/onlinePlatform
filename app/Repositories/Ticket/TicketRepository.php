<?php

namespace App\Repositories\Ticket;

use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketRepository implements ITicketRepository
{
    private $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function saveTicket(Request $request)
    {
        $reference_no = uniqid();

        $ticket = new $this->ticket;
        $ticket->cust_name = $request->input('cust_name');
        $ticket->problem_desc = $request->input('desc');
        $ticket->email = $request->input('email');
        $ticket->phone_no = $request->input('phone_no');
        $ticket->reference_no = $reference_no;
        $ticket->status = 'PENDING';
        $ticket->save();

        return $reference_no;
    }

    public function updateTicketStatus(Request $request)
    {
        $ticket = $this->ticket->find($request->input('ticket_id'));
        $ticket->status = 'OPENED';

        return $ticket->save();
    }

    public function getAll()
    {
        return $this->ticket->orderBy('status', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
    }

    public function searchTicket(Request $request)
    {
        $request_type = $request->input('request_type');
        $reference_no = $request->input('reference_no');
        $cust_name = $request->input('cust_name');

        if ($request_type == "CUSTOMER") {
            $data = $this->ticket->where('reference_no', $reference_no)->first();

        } else {

            $data = $this->ticket;
            if ($reference_no != '') {
                $data = $data->where('reference_no', $reference_no);
            }
            if ($cust_name != '') {
                $data = $data->where('cust_name', 'like', '%' . $cust_name . '%');
            }

            $data = $data->orderBy('status', 'DESC')->orderBy('created_at', 'DESC');

            $data = $data->paginate(10);
        }
        return $data;
    }

    function getTicketDetails(Request $request)
    {
        return $this->ticket->find($request->input('id'));
    }

}
