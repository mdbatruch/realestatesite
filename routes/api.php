<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\House;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/neighbourhoods/upsert', 'App\Http\Controllers\NeighbourhoodController@upsert');

Route::delete('/neighbourhoods/{neighbourhood}', 'App\Http\Controllers\NeighbourhoodController@destroy');

Route::post('/house-items/add', 'App\Http\Controllers\HouseController@store');
Route::delete('/house-items/{house}', 'App\Http\Controllers\HouseController@destroy');

Route::post('/add-image', function (Request $request) {
    $file = $request->file('file');
    $dir = 'public/images';
    $path = $file->store($dir);
    return str_replace("$dir/", '', $path);
});

Route::get('/house-items/{house}', function (House $house) {
    return $house;
});

Route::post('/house-items/{house}', 'App\Http\Controllers\HouseController@update');

Route::get('/neighbourhoods/{neighbourhood}/houses', 'App\Http\Controllers\NeighbourhoodController@items');