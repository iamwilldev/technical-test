<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DefaultResource extends ResourceCollection
{
    public $status;

    public $message;

    public $resource;

    /**
     * __construct
     *
     * @param  mixed  $status
     * @param  mixed  $message
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }
}
