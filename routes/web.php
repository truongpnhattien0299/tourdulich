<?php

use Illuminate\Support\Facades\Route;

// use App\Models\Khachang;

Route::group(['prefix' => 'customer'], function () {
    Route::get('listcus', 'KhachangController@getKH');
    Route::get('addcus', 'KhachangController@getAddKH');
    Route::post('addcus', 'KhachangController@postAddKH');
    Route::get('editcus&id={id}', 'KhachangController@getEditKH');
    Route::post('editcus&id={id}', 'KhachangController@postEditKH');
    Route::get('deletecus&id={id}', 'KhachangController@deleteKH');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('listcate', 'LoaitourController@getLoai');
    Route::get('addcate', 'LoaitourController@getAddLoai');
    Route::post('addcate', 'LoaitourController@postAddLoai');
});
