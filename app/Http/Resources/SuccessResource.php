<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    const DEFAULT_MESSAGE = 'success';
    /**
     * @var null
     */
    private $message;

    /**
     * SuccessResource constructor.
     * @param      $resource
     * @param null $message
     */
    public function __construct($resource = [], $message = self::DEFAULT_MESSAGE)
    {
        parent::__construct($resource);
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->resource,
            'message' => $this->message ,
        ];
    }
}
