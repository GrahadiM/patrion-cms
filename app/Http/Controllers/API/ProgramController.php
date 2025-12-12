<?php

namespace App\Http\Controllers\Api;

use App\Models\Program;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProgramResource;

class ProgramController extends Controller
{
    public function index()
    {
        $data = Program::whereIn('status', ['upcoming', 'ongoing', 'released'])
            ->orderBy('order')
            ->get();

        return ProgramResource::collection($data);
    }

    public function show($slug)
    {
        $data = Program::where('slug', $slug)->firstOrFail();
        return new ProgramResource($data);
    }

    public function filterByStatus($status)
    {
        $data = Program::where('status', $status)
            ->orderBy('order')
            ->get();

        return ProgramResource::collection($data);
    }
}
