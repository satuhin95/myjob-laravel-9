<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

Route::get('/', [ListingController::class,'index'])->name('home');
Route::get('/listing/create', [ListingController::class,'create'])->name('listing.create')->middleware('auth');
Route::post('/listing', [ListingController::class,'store'])->name('listing.store')->middleware('auth');
Route::get('/listing/{listing}/edit', [ListingController::class,'edit'])->name('listing.edit')->middleware('auth');
Route::put('/listing/{listing}', [ListingController::class,'update'])->name('listing.update')->middleware('auth');
Route::delete('/listing/{listing}', [ListingController::class,'destroy'])->name('listing.delete')->middleware('auth');
Route::get('/listing/manage', [ListingController::class,'manage'])->name('listing.manage')->middleware('auth');

Route::get('/listing/{listing}',[ListingController::class,'show'])->name('listing.show');



// user controller 
Route::get('/register', [UserController::class,'create'])->name('register')->middleware('guest');
Route::post('/user', [UserController::class,'store']);
Route::post('/logout', [UserController::class,'logout'])->name('logout')->middleware('auth');
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class,'authenticate'])->name('login.authenticate');


