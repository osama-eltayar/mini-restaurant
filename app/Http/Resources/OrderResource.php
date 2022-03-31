<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'table'       => new TableResource($this->whenLoaded('table')),
            'customer'    => new CustomerResource($this->whenLoaded('customer')),
            'waiter'      => new WaiterResource($this->whenLoaded('waiter')),
            'reservation' => new ReservationResource($this->whenLoaded('reservation')),
            'details'     => OrderDetailResource::collection($this->whenLoaded('details')),
            'total_paid'  => $this->total_paid,
            'date'        => $this->created_at
        ];
    }
}
