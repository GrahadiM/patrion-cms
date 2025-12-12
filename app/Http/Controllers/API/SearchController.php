<?php

namespace App\Http\Controllers\Api;

use App\Models\Character;
use App\Models\Program;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search()
    {
        $q = request('q', '');

        return response()->json([
            'characters' => Character::where('name', 'like', "%$q%")
                                     ->orWhere('slug', 'like', "%$q%")
                                     ->take(10)->get(),
            'programs' => Program::where('title', 'like', "%$q%")
                                 ->orWhere('slug', 'like', "%$q%")
                                 ->take(10)->get(),
        ]);
    }
}
