<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Cases extends JsonResource {
    public function toArray($request){
        return [
            'id'    => $this->id,
            'client_name'   => $this->client_name,
            'opponent_name' => $this->opponent_name,
            'dealer'    => $this->dealer,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at
        ];
    }
}