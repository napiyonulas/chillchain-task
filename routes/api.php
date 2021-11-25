<?php

use App\Http\Controllers\api\AddressController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CompanyController;
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



Route::apiResource('companies', CompanyController::class);
Route::apiResource('addresses', AddressController::class);
Route::apiResource('contacts', ContactController::class);
Route::get('countries',[CountryController::class,'index']);

