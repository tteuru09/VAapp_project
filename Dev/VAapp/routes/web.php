<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RowerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\CanoeController;
use App\Http\Controllers\SlotCanoeController;
use App\Http\Controllers\SlotRowerController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
})->name('test');

Route::middleware(['auth', 'verified', 'rower'])->group(function () {
    Route::get('/dashboard.rower',[RowerController::class, 'index'])->name('dashboard.rower');
    Route::get('/slot.rower',[RowerController::class, 'show_slot'])->name('slot.rower');
    Route::post('reserve_place',[RowerController::class, 'reserve_place'])->name('reserve_place');
    Route::delete('cancel_reserve',[RowerController::class, 'cancel_reserve'])->name('cancel_reserve');
});

Route::middleware(['auth', 'verified', 'trainer'])->group(function () {

    Route::get('/dashboard.trainer', [TrainerController::class, 'index'])->name('dashboard.trainer');
    Route::get('/slot.trainer',[TrainerController::class, 'show_slot'])->name('slot.trainer');
    Route::get('/canoe.trainer',[TrainerController::class, 'show_canoe'])->name('canoe.trainer');

    /* CRUD Slots */
    Route::delete('/slot.trainer',[SlotController::class, 'destroy'])->name('slot.destroy');
    Route::post('add_slot',[SlotController::class, 'store'])->name('add_slot');
    Route::put('edit_slot',[SlotController::class, 'edit'])->name('edit_slot');

    /* CRUD Canoes */
    Route::delete('/canoe.trainer',[CanoeController::class, 'destroy'])->name('canoe.destroy');
    Route::post('add_canoe',[CanoeController::class, 'store'])->name('add_canoe');
    Route::put('edit_canoe',[CanoeController::class, 'edit'])->name('edit_canoe');
});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/dashboard.admin', [AdminController::class, 'index'])->name('dashboard.admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
