<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Gamesheet extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'template' => $this->template,
            'downloads' => $this->downloads,
            'created_by' => $this->createdBy,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
