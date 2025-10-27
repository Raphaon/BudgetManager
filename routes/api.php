<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BudgetAnalyticsController;

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


Route::get('/test', function () {
    $users = array('login' => "rapha",  "password" => "test");
    return response()->json($users);
});

Route::prefix('budget')->group(function () {
    Route::get('snapshot', [BudgetAnalyticsController::class, 'snapshot']);
    Route::get('comparison', [BudgetAnalyticsController::class, 'comparison']);
    Route::get('report', [BudgetAnalyticsController::class, 'report']);
    Route::get('alerts', [BudgetAnalyticsController::class, 'alerts']);
    Route::post('scenario', [BudgetAnalyticsController::class, 'scenario']);
});
