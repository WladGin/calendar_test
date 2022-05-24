<?php

namespace App\Http\API\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        $return['id'] = $response['id'];
        $return['title'] = $response['title'];
        $return['start'] = $response['start_event'];
        $return['end'] = $response['end_event'];

        return $return;
    }
}
