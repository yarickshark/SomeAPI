<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\GuestMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[MainController::class, 'main']);

Route::get('/about',[MainController::class, 'about']);

Route::get('/current_collections',[MainController::class, 'current_collections'])->name('current_collections');

Route::get('/done_collections',[MainController::class, 'done_collections'])->name('done_collections');

Route::get('/collection/{id}', [MainController::class, 'collection'])->name('collection');

Route::post('/current_collection/check',[MainController::class, 'current_collection_check']);

Route::get('/donate/{id}', [MainController::class, 'donate'])->name('donate');

Route::post('/donated/{id}',[MainController::class, 'donated']);

Route::get('/collection_edit/{id}',[MainController::class, 'collection_edit']);
Route::get('collection_edit/{id}/check', [MainController::class, 'edit'])->name('collection.edit');
Route::patch('collection_update/{id}', [MainController::class, 'update'])->name('collection.update');

Route::get('/contr_edit/{id}',[MainController::class, 'contr_edit'])->name('contr_edit');
Route::get('/donate_edit/{id}',[MainController::class, 'donate_edit'])->name('donate_edit');
Route::patch('/donate_update/{id}', [MainController::class, 'donate_update'])->name('donater.update');

Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/collection/{id}/delete', [MainController::class, 'delete'])->name('delete');
Route::get('/contr/{id}/delete', [MainController::class, 'delete_contr'])->name('delete_contr');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
