<?php

use Illuminate\Support\Facades\Route;

// use App\Models\Khachang;

Route::group(['prefix' => 'customer'], function () {
    Route::get('list', 'KhachangController@getKH');
    Route::get('add', 'KhachangController@getAddKH');
    Route::post('add', 'KhachangController@postAddKH');
    Route::get('edit&id={id}', 'KhachangController@getEditKH');
    Route::post('edit&id={id}', 'KhachangController@postEditKH');
    Route::get('delete&id={id}', 'KhachangController@deleteKH');
});

// Route::get('test', function () {
//     $kh = Khachang::all();
//     foreach($kh as $item)
//     {
//         echo $item->kh_ten;
//     }
// });
