<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRelatedFactResource extends JsonResource
{
    /**
     *
     * Transform the resource into an array.
     *
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'description' => $this->description,
            'is_contain_numbers' => $this->is_contain_numbers
        ];
    }
}
