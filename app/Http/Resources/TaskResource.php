<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //transforms the resource into an array made up of the attributes to be converted to JSON
        return [
            'id' => $this->id,
            'description' => $this->description,
            'level_id'=> $this->level_id,
            'completed'=> $this->completed,
            'completed_at'=>$this->completed_at,
            'title'=> $this->level->title,
            'color'=> $this->level->color
        ];
    }
}
