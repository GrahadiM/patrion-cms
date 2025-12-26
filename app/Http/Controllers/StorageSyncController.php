<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class StorageSyncController extends Controller
{
    public function sync()
    {
        if (request('key') !== env('SYNC_KEY')) {
            abort(403, 'Unauthorized');
        }

        $source = storage_path('app/public');
        $destination = public_path('storage');

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        File::copyDirectory($source, $destination);

        return 'OK';
    }
}
