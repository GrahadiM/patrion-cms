<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'slug'        => $this->slug,
            'description' => $this->description,
            'synopsis'    => $this->synopsis,
            'thumbnail'   => $this->thumbnail,
            'image'       => $this->image,
            'trailer'     => $this->trailer,
            'platform'    => $this->platform,
            'platforms'   => $this->platforms,
            'status'      => $this->status,
            'release_date'=> $this->release_date,
            'duration'    => $this->duration,
            'rating'      => $this->rating,
            'director'    => $this->director,
            'budget'      => $this->budget,
            'episodes'    => $this->episodes,
            'views'       => $this->views,
            'characters'  => $this->characters,
            'production'  => $this->production,
            'gallery'     => $this->gallery,
            'order'       => $this->order,
        ];
    }
}
