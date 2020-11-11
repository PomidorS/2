<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ListController;

    //роуты по авторизации
    Route::post('register', 'AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('logout','AuthController@logout')->middleware('auth:api');

    //роуты для списков
    Route::get('list/output','ListController@outputList');
    Route::get('list/output/dela/{id}','ListController@output');
    Route::delete('list/delete/{id}','ListController@outputDelete');
    Route::post('list/create','ListController@create_lists');

    //роуты для дел
    Route::post('task/create', 'TaskController@create_task');
    Route::get('task/output/{id}', 'TaskController@output');
    Route::put('task/edit/{id}', 'TaskController@outputEdit');
    Route::delete('task/delete/{id}', 'TaskController@outputDelete');
    Route::post('task/mark_state_of_affairs/{id}', 'TaskController@state_of_affairs');


