<?php

use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\ClassController;
use App\Http\Controllers\API\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;

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

Route::apiResources([
    'user' => UserController::class,
    'state' => StateController::class,
    'city' => CityController::class,
    'classes' => ClassController::class,
    'regstudent' => StudentController::class,

]);

// Route::get('profile', [UserController::class, 'profile']);
// Route::get('findUser', [UserController::class, 'search']);
// Route::get('findLocation', [LocationController::class, 'search']);
// Route::get('findProperty', [PropertyController::class, 'search']);
// Route::get('findOrder', [OrderController::class, 'search']);
// Route::get('findClient', [ClientController::class, 'search']);
// Route::put('locstatus/{id}', [LocationController::class, 'updateStatus']);
// Route::put('typestatus/{id}', [TypeController::class, 'updateStatus']);
// Route::put('propertystatus/{id}', [PropertyController::class, 'updateStatus']);
// Route::put('orderStatus/{id}', [PropertyController::class, 'updateOrder']);
// Route::get('singleOrder', [OrderController::class, 'singleOrder']);
// Route::get('print/{id}', [OrderController::class, 'singleOrder']);
// Route::get('totalOrders', [OrderController::class, 'totalOrder']);
// Route::get('totalClients', [ClientController::class, 'totalClients']);
// Route::get('totalLocation', [LocationController::class, 'totalLocation']);
// Route::get('totalPlots', [PropertyController::class, 'totalPlots']);
// Route::get('recentOrder', [OrderController::class, 'recentOrder']);
// Route::get('recentPlots', [PropertyController::class, 'recentPlots']);
// Route::get('clientList', [ClientController::class, 'clientList']);
// Route::get('userList', [UserController::class, 'userList']);
// Route::get('propertiesList', [PropertyController::class, 'propertiesList']);
