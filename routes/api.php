<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'AuthController@login');
Route::middleware('JwtAuth')->post('me', 'AuthController@me');

Route::middleware('JwtAuth')->post('logout', 'AuthController@logout');
Route::middleware('JwtAuth')->post('refresh', 'AuthController@refresh');
Route::middleware('JwtAuth')->post('payload', 'AuthController@payload');

Route::group(['middleware' => 'JwtAuth'],function (){
    Route::post('posts','PostController@index');
    Route::post('posts/{id}','PostController@show');
    Route::post('posts/create','PostController@store');
    Route::post('posts/{id}/update','PostController@update');
    Route::post('posts/{id}/delete','PostController@destroy');



});






