<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LogUserActivity;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\ActivityLogController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () { return redirect(route('login')); });

Route::get('/swagger', function () {
    return file_get_contents(public_path('swagger/index.html'));
});

Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['web', LogUserActivity::class])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Characters Routes
        Route::prefix('characters')->name('characters.')->group(function () {
            Route::get('/', [CharacterController::class, 'index'])->name('index');
            Route::get('/create', [CharacterController::class, 'create'])->name('create');
            Route::post('/', [CharacterController::class, 'store'])->name('store');
            Route::get('/{character}', [CharacterController::class, 'show'])->name('show');
            Route::get('/{character}/edit', [CharacterController::class, 'edit'])->name('edit');
            Route::put('/{character}', [CharacterController::class, 'update'])->name('update');
            Route::delete('/{character}', [CharacterController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-destroy', [CharacterController::class, 'bulkDestroy'])->name('bulk-destroy');
        });

        // Programs Routes
        Route::prefix('programs')->name('programs.')->group(function () {
            Route::get('/', [ProgramController::class, 'index'])->name('index');
            Route::get('/create', [ProgramController::class, 'create'])->name('create');
            Route::post('/', [ProgramController::class, 'store'])->name('store');
            Route::get('/{program}', [ProgramController::class, 'show'])->name('show');
            Route::get('/{program}/edit', [ProgramController::class, 'edit'])->name('edit');
            Route::put('/{program}', [ProgramController::class, 'update'])->name('update');
            Route::delete('/{program}', [ProgramController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-destroy', [ProgramController::class, 'bulkDestroy'])->name('bulk-destroy');
        });

        // Activity Logs Routes
        Route::prefix('activity-logs')->name('activity-logs.')->group(function () {
            Route::get('/', [ActivityLogController::class, 'index'])->name('index');
            Route::get('/{activity}', [ActivityLogController::class, 'show'])->name('show');
            Route::delete('/{activity}', [ActivityLogController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-destroy', [ActivityLogController::class, 'bulkDestroy'])->name('bulk-destroy');
            Route::post('/clear-all', [ActivityLogController::class, 'clearAll'])->name('clear-all');
            Route::get('/export', [ActivityLogController::class, 'export'])->name('export');
        });

        // Users Routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/bulk-destroy', [UserController::class, 'bulkDestroy'])->name('bulk-destroy');
            Route::post('/bulk-status', [UserController::class, 'bulkStatus'])->name('bulk-status');
            Route::get('/export', [UserController::class, 'export'])->name('export');
        });
    });
});

require __DIR__.'/auth.php';
