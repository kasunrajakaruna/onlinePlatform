<?php

namespace Kinderm8\Http\Resources;
use Helpers;
use Log;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource)
    {

        // Ensure you call the parent constructor
        parent::__construct($resource);

        $this->resource = $resource;
    }

    public function toArray($request)
    {
        $prop = [
            'id' => $this->index,
            'cust_name' => $this->cust_name,
            'problem_desc' => $this->problem_desc,
            'email' => $this->email,
            'phone_no' => $this->phone_no,
            'reference_no' => $this->reference_no,
            'status' => $this->status,
            'actioned_date' => $this->actioned_date,
            'actioned_user' => $this->actioned_user,
            'replies' => $this->replies
        ];
        return $prop;
    }
}
