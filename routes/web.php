<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'Listgroup'], function () {
    Route::get('listlgrp', 'ListgroupController@getListgroup');
    Route::get('addlgrp', 'ListgroupController@getAddListgroup');
    Route::post('addlgrp', 'ListgroupController@postAddListgroup');
    Route::get('editlgrp&id={id}', 'ListgroupController@getEditListgroup');
    Route::post('editlgrp&id={id}', 'ListgroupController@postEditListgroup');
    Route::get('delete&id={id}', 'ListgroupController@deleteEmployee');
});
Route::group(['prefix' => 'Group'], function () {
    Route::get('listgrp', 'groupController@getGroup');
    Route::get('addgrp', 'groupController@getAddGroup');
    Route::post('addgrp', 'groupController@postAddGroup');
    Route::get('editgrp&id={id}', 'groupController@getEditGroup');
    Route::post('editgrp&id={id}', 'groupController@postEditGroup');
    Route::get('delete&id={id}', 'groupController@deleteGroup');
    Route::get('price&id={id}&start={start}', 'groupController@priceGroup');
});


Route::group(['prefix' => 'Location'], function () {
    Route::get('listlct', 'locationController@getlocation');
    Route::get('addlct', 'locationController@getAddlocation');
    Route::post('addlct', 'locationController@postAddlocation');
    Route::get('editlct&id={id}', 'locationController@getEditlocation');
    Route::post('editlct&id={id}', 'locationController@postEditlocation');
    Route::get('delete&id={id}', 'locationController@deletelocation');
});

Route::group(['prefix' => 'tourprice'], function () {
    Route::get('listprc', 'tourpriceController@gettourprice');
    Route::get('addprc', 'tourpriceController@getAddtourprice');
    Route::post('addprc', 'tourpriceController@postAddtourprice');
    Route::get('editprc&id={id}', 'tourpriceController@getEdittourprice');
    Route::post('editprc&id={id}', 'tourpriceController@postEdittourprice');
    Route::get('delete&id={id}', 'tourpriceController@deletetourprice');
    Route::get('search&id={id}', 'tourpriceController@searchTourPrice');
    Route::get('price&id={id}', 'tourpriceController@priceTourPrice');
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
    Route::get('delete&id={id}', 'TourController@deleteTour');
    Route::get('ajax&id={id}', 'TourController@ajaxTour');
    Route::get('popup&id={id}', 'TourController@popTour');
});

Route::group(['prefix' => 'typecost'], function () {
    Route::get('listtc', 'LoaichiphiController@getTc');
    Route::get('addtc', 'LoaichiphiController@getAddTc');
    Route::post('addtc', 'LoaichiphiController@postAddTc');
    Route::get('edit&id={id}', 'LoaichiphiController@getEditTc');
    Route::post('edit&id={id}', 'LoaichiphiController@postEditTc');
    Route::get('delete&id={id}', 'LoaichiphiController@deleteTc');
});

Route::group(['prefix' => 'cost'], function () {
    Route::get('addcp&id={id}', 'ChiphiController@getAddCp');
    Route::post('addcp&id={id}', 'ChiphiController@postAddCp');
    // Route::get('edit&id={id}', 'ChiphiController@getEditCp');
    Route::post('edit&id={id}', 'ChiphiController@postEditCp');
    // Route::get('delete&id={id}', 'ChiphiController@deleteCp');
});
