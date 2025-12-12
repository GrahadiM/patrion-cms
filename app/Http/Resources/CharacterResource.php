<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'full_name'   => $this->full_name,
            'region'      => $this->region,
            'philosophy'  => $this->philosophy,
            'height'      => $this->height,
            'weight'      => $this->weight,
            'artifact'    => $this->artifact,
            'power'       => $this->power,
            'island'      => $this->island,
            'origin'      => $this->origin,
            'dna'         => $this->dna,
            'attitude'    => $this->attitude,
            'character'   => $this->character,
            'colors'      => $this->colors,
            'color_names' => $this->color_names,
            'image'       => $this->image,
            'thumbnail'   => $this->thumbnail,
            'video'       => $this->video,
            'description' => $this->description,
            'status'      => $this->status,
            'order'       => $this->order,
            'created_at'  => $this->created_at,
        ];
    }
}
