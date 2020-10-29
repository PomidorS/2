<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Popitka1;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('/dela/output/{id}',function(int $id){
    if($id < 0 or $id>100){$id = 10;}
    return "output dela:". $id;
});
*/
Route::post('/dela/output','popitka1@create_task');
Route::get('dela/output/{id}','popitka1@output');
Route::put('dela/output/{output}','popitka1@outputEdit');
Route::delete('dela/output/{output}','popitka1@outputDelete');


