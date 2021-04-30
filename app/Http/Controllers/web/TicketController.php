<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\AcknowledgeMAil;
use App\Mail\ReplyMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Repositories\Ticket\ITicketRepository;
use App\Repositories\Reply\IReplyRepository; 
use App\Http\Resources\Ticket\TicketResourceCollection;
use Illuminate\Support\Facades\Mail;
use DB;
use Log;

class TicketController extends Controller
{

    private $ticketRepo;
    private $replyRepo;

    public function __construct(ITicketRepository $ticketRepo, IReplyRepository $replyRepo)
    {
        $this->ticketRepo = $ticketRepo;
        $this->replyRepo = $replyRepo;
    }

    /**
     * save tickets by a customer
     * @param Request $request
     * @return $id
     */
    function saveTicket(Request $request)
    {
        $validate = Validator::make($request->input(), array(
            'cust_name' => 'required',
            'desc' => 'required',
            'email' => 'required|email'
        ));

        if ($validate->fails()) {
            return array('code' => 400, 'error' => $validate->messages());
        }

        DB::beginTransaction();
        try {

            $reference_no = $this->ticketRepo->saveTicket($request);

            DB::commit();

            Mail::to($request->input('email'))->send(new AcknowledgeMAil($reference_no));

            return array(
                'code' => 200,
                'reference_no' => $reference_no,
                'message' => 'record saved successfully'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            log::info($e);
            return array(
                'code' => 401,
                'message' => 'Something went wrong.'
            );
        }

    }

    
    /**
     * display ticket list to support agent
     * @param Request $request
     * @return collection
     */
    function getTicketList()
    {

        $tickets = $this->ticketRepo->getAll();
        // $tickets = new TicketResourceCollection($tickets);

        return View::make('manage_tickets.ticket_list', compact('tickets'));

    }


    /**
     * search ticket by reference no
     * @param Request $request
     * @return collection
     */
    function searchTicketByCustomer(Request $request)
    {
        $ticketDetails = $this->ticketRepo->searchTicket($request);

        return array(
            'code' => 200,
            'content' => View::make('dashboard.ticket_view', compact('ticketDetails'))->render()
        );

    }


    /**
     * search ticket by agent
     * @param Request $request
     * @return collection
     */
    function searchTicketByAgent(Request $request)
    {
        $tickets = $this->ticketRepo->searchTicket($request);

        return array(
            'code' => 200,
            'content' => (count($tickets)>0)? View::make('manage_tickets.ticket_list_tbl', compact('tickets'))->render(): 'No Records to show'
        );

    }


    /**
     * returns ticket view
     * @param Request $request
     * @return view
     */
    function getOpenTicketView(Request $request)
    {
        $ticketDetails = $this->ticketRepo->getTicketDetails($request);

        return array(
            'code' => 200,
            'message' => View::make('manage_tickets.agent_ticket_view', compact('ticketDetails'))->render()
        );
    }

    /**
     * agent save a reply
     * @param Request $request
     * @return array
     */
    function saveReply(Request $request)
    {

        $validate = Validator::make($request->input(), array(
            'tckt_reply' => 'required'
        ));

        if ($validate->fails()) {
            return array('code' => 400, 'error' => $validate->messages());
        }

        DB::beginTransaction();
        try {

            $this->ticketRepo->updateTicketStatus($request);
            $this->replyRepo->saveReply($request);

            DB::commit();

            Mail::to($request->input('email'))->send(new ReplyMail($request->input('tckt_reply'), $request->input('reference_no')));

            return array(
                'code' => 200,
                'ticket_id' => $request->input('ticket_id'),
                'message' => 'Reply saved successfully'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            log::info($e);
            return array(
                'code' => 401,
                'message' => 'Something went wrong.'
            );
        }
    }

}
