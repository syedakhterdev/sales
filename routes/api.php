<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('/customers', 'Api\CustomerController@getAllCustomers');
Route::get('/employees', 'Api\EmployeeController@getAllEmployees');

Route::put('/customers/{id}','Api\CustomerController@update');
Route::post('/customers','Api\CustomerController@store');
