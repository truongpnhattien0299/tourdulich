<?php

use Illuminate\Support\Facades\Route;

// use App\Models\Khachang;

Route::group(['prefix' => 'customer'], function () {
    Route::get('listcus', 'KhachangController@getKH');
    Route::get('addcus', 'KhachangController@getAddKH');
    Route::post('addcus', 'KhachangController@postAddKH');
    Route::get('editcus&id={id}', 'KhachangController@getEditKH');
    Route::post('editcus&id={id}', 'KhachangController@postEditKH');
    Route::get('delete&id={id}', 'KhachangController@deleteKH');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('listcate', 'LoaitourController@getLoai');
    Route::get('addcate', 'LoaitourController@getAddLoai');
    Route::post('addcate', 'LoaitourController@postAddLoai');
    Route::get('editcate&id={id}', 'LoaitourController@getEditLoai');
    Route::post('editcate&id={id}', 'LoaitourController@postEditLoai');
    Route::get('delete&id={id}', 'LoaitourController@deleteLoai');
});
