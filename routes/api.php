<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ListController;



    //роуты для списков
    Route::get('list/output','ListController@output');
    Route::delete('list/delete/{id}','ListController@outputDelete');
    Route::post('list/create','ListController@create_lists');

    //роуты для дел
    Route::post('task/create', 'TaskController@create_task');
    Route::get('task/output/{id}', 'TaskController@output');
    Route::put('task/edit/{id}', 'TaskController@outputEdit');
    Route::delete('task/delete/{id}', 'TaskController@outputDelete');


