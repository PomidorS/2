<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ListController;


Route::group(['prefix'=>'list'], function (){
    //роуты для списков
    Route::get('/output','ListController@output');
    Route::delete('/delete/{id}','ListController@outputDelete');
    Route::post('/output','ListController@create_lists');
    //роуты для дел
    Route::post('/task/output', 'TaskController@create_task');
    Route::get('/task/output/{id}', 'TaskController@output');
    Route::put('/task/edit/{id}', 'TaskController@outputEdit');
    Route::delete('/task/delete/{id}', 'TaskController@outputDelete');
});

