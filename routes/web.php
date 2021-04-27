<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('animals', AnimalController::class);

Auth::routes();

Route::get('/'    , [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('animals/{id}/', [App\Http\Controllers\AdoptionRequestController::class, 'store'])->name('adopt');

Route::get   ('adoptions', [App\Http\Controllers\AdoptionRequestController::class, 'index'])->name('adoptions.index');
Route::post  ('adoptions', [App\Http\Controllers\AdoptionRequestController::class, 'update'])->name('adoptions.update');
// Route::post  ('adoptions', [App\Http\Controllers\AdoptionRequestController::class, 'approve'])->name('adoptions.approve');
// Route::patch ('adoptions', [App\Http\Controllers\AdoptionRequestController::class, 'deny'])->name('adoptions.deny');

Route::get('adoptions/requests', [App\Http\Controllers\AdoptionRequestController::class, 'showUserRequests'])->name('adoptions.show_requests');
Route::delete ('adoptions', [App\Http\Controllers\AdoptionRequestController::class, 'destroy'])->name('adoptions.destroy');

Route::get('adoptions/owners', [App\Http\Controllers\AdoptionRequestController::class, 'showOwners'])->name('adoptions.show_owners');