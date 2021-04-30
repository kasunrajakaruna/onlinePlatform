<?php

namespace Kinderm8\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketResourceCollection extends ResourceCollection
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

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource) || empty($this->resource) || is_null($this->collection))
        {
            return [];
        }

        $this->collection->transform(function ($data)
        {
            return (new TicketResource($data));
        });

        return parent::toArray($request);
        
    }
}
