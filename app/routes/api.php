<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;

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

// route question 

    Route::get('/questions' ,[QuestionController::class , 'index']);
    Route::get('/questions/{id}', [QuestionController::class , 'edit']);
    Route::post('/questions/create' ,[QuestionController::class , 'store']);
    Route::delete('/questions/delete/{id}' ,[QuestionController::class , 'delete']);
    Route::put('/questions/update/{id}' ,[QuestionController::class , 'update']);

// route answer

