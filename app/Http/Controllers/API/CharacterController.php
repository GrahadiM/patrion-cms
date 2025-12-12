<?php

namespace App\Http\Controllers\Api;

use App\Models\Character;
use App\Http\Controllers\Controller;
use App\Http\Resources\CharacterResource;

class CharacterController extends Controller
{
    public function index()
    {
        $data = Character::where('status', 'published')
            ->orderBy('order')
            ->get();

        return CharacterResource::collection($data);
    }

    public function show($slug)
    {
        $data = Character::where('slug', $slug)->firstOrFail();
        return new CharacterResource($data);
    }

    public function filterByStatus($status)
    {
        $data = Character::where('status', $status)
            ->orderBy('order')
            ->get();

        return CharacterResource::collection($data);
    }
}
