<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ImprovementController;
use App\Http\Controllers\TeamController;

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    })->name('custom.logout');

    Route::get('/home', [ProjetController::class, 'userProjects'])->name('mes-projets');
    Route::get('/projets/{id}', [ProjetController::class, 'showProjet'])->name('projets.show');

    Route::middleware('role:admin')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{user}', [UserController::class, 'show']);
        Route::put('/{user}', [UserController::class, 'update']);
        Route::delete('/{user}', [UserController::class, 'destroy']);
    });

    Route::resource('projets', ProjetController::class)->except(['create', 'edit']);
    Route::resource('comments', CommentController::class)->except(['create', 'edit']);
    Route::resource('issues', IssueController::class)->except(['create', 'edit']);
    Route::resource('improvements', ImprovementController::class)->except(['create', 'edit']);

    Route::middleware('role:admin')->prefix('teams')->group(function () {
        Route::get('/', [TeamController::class, 'index']);
        Route::post('/', [TeamController::class, 'store']);
        Route::get('/{team}', [TeamController::class, 'show']);
        Route::put('/{team}', [TeamController::class, 'update']);
        Route::delete('/{team}', [TeamController::class, 'destroy']);
    });
});
