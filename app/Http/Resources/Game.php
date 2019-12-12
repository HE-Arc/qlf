<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Gamesheet as GamesheetResource;
use App\Gamesheet as Gamesheet;

class Game extends JsonResource
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
            'created_by' => $this->created_by, //todo: change it when it's a foreign key
            'scores' => $this->scores,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'gamesheet' => new GamesheetResource(Gamesheet::find($this->gamesheet_id)),
            'players' => $this->users
        ];
    }
}
