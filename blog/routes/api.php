<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\AccountController;
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

Route::post('signup', 'Account\AccountController@register'); Route::post('login', 'Account\AccountController@login');

Route::group(['middleware' => 'jwt.auth'], function () { Route::get('auth', 'AccountController@user'); Route::post('logout', 'AccountController@logout'); });

Route::middleware('jwt.refresh')->get('/token/refresh', 'AccountController@refresh');
