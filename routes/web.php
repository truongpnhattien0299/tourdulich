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

Route::group(['prefix' => 'Employee'], function () {
    Route::get('listemp', 'EmployeeController@getEmployee');
    Route::get('addemp', 'EmployeeController@getAddEmployee');
    Route::post('addemp', 'EmployeeController@postAddEmployee');
    Route::get('editemp&id={id}', 'EmployeeController@getEditEmployee');
    Route::post('editemp&id={id}', 'EmployeeController@postEditEmployee');
    Route::get('delete&id={id}', 'EmployeeController@deleteEmployee');
});

Route::group(['prefix' => 'Group'], function () {
    Route::get('listgrp', 'GroupController@getGroup');
    Route::get('addgrp', 'GroupController@getAddGroup');
    Route::post('addgrp', 'GroupController@postAddGroup');
    Route::get('editgrp&id={id}', 'GroupController@getEditGroup');
    Route::post('editgrp&id={id}', 'GroupController@postGroup');
    Route::get('delete&id={id}', 'GroupController@deleteGroup');
});


Route::group(['prefix' => 'Location'], function () {
    Route::get('listlct', 'locationController@getlocation');
    Route::get('addlct', 'locationController@getAddlocation');
    Route::post('addlct', 'locationController@postAddlocation');
    Route::get('editlct&id={id}', 'locationController@getEditlocation');
    Route::post('editlct&id={id}', 'locationController@postEditlocation');
    Route::get('delete&id={id}', 'locationController@deletelocation');
});

Route::group(['prefix' => 'category'], function () {
    Route::get('listcate', 'LoaitourController@getLoai');
    Route::get('addcate', 'LoaitourController@getAddLoai');
    Route::post('addcate', 'LoaitourController@postAddLoai');
    Route::get('editcate&id={id}', 'LoaitourController@getEditLoai');
    Route::post('editcate&id={id}', 'LoaitourController@postEditLoai');
    Route::get('delete&id={id}', 'LoaitourController@deleteLoai');
});

Route::group(['prefix' => 'tour'], function () {
    Route::get('listtour', 'TourController@getTour');
    Route::get('addtour', 'TourController@getAddTour');
    Route::post('addtour', 'TourController@postAddTour');
    Route::get('edit&id={id}', 'TourController@getEditTour');
    Route::post('edit&id={id}', 'TourController@postEditTour');
    Route::get('delete&id={id}', 'LoaitourController@deleteLoai');
});
