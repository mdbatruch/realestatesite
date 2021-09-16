<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome', $neighbourhoods);
// });

Auth::routes(['verify' => true]);

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/neighbourhoods', 'App\Http\Controllers\NeighbourhoodController@index');

Route::get('/neighbourhood-editor/{any?}', 'App\Http\Controllers\AdminController@neighbourhood')
->middleware('can:edit-neighbourhood')
->where('any', '.*')
->name('neighbourhood-editor');
