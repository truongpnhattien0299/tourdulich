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
// use App\Models\Khachang;

Route::group(['prefix' => 'customer'], function () {
    Route::get('list', 'KhachangController@getKH');
    Route::get('add', 'KhachangController@getAddKH');
    Route::post('add', 'KhachangController@postAddKH');
});

// Route::get('test', function () {
//     $kh = Khachang::all();
//     foreach($kh as $item)
//     {
//         echo $item->kh_ten;
//     }
// });
