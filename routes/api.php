<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerFORTask;
use App\Http\Controllers\ControllerForList;


Route::group(['prefix'=>'work_with'], function (){
    //роуты для списков
    Route::get('/lists/output','ControllerForList@create_lists');
    Route::delete('/lists/output','ControllerForList@outputDelete');
    //роуты для дел
    Route::post('/dela/output', 'ControllerFORTask@create_task');
    Route::get('dela/output/{id}', 'ControllerFORTask@output');
    Route::put('dela/output/{id}', 'ControllerFORTask@outputEdit');
    Route::delete('dela/output/{id}', 'ControllerFORTask@outputDelete');
});

