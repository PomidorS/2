<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index');
#Route::get('/', function (){ return view('welcome');});
Auth::routes();
Route::get('/test/{date}', 'IndexController@test');
Route::get('/about/api',function (){return "about";});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::get('/dela/output/{id}',function(int $id){
    if($id < 0 or $id>100){$id = 10;}
    return "output dela:". $id;
});
*/


