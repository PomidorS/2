<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerFORbd;



Route::post('/dela/output','ControllerFORbd@create_task');
Route::get('dela/output/{id}','ControllerFORbd@output');
Route::put('dela/output/{output}','ControllerFORbd@outputEdit');
Route::delete('dela/output/{output}','ControllerFORbd@outputDelete');


