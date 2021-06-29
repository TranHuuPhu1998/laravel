<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskItemController;
use App\Http\Controllers\ProjectManagerController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\FileController;
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
// route auth
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('forgot-password', 'ResetPasswordController@forgot');
    Route::post('reset-password', 'ResetPasswordController@reset');
    
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::delete('/logout', 'AuthController@logout');
        Route::get('/user', 'AuthController@user');
    });
});

// route questions 
Route::group([ 
    'prefix' => 'questions'
], function(){
    Route::get('/' ,[QuestionController::class , 'index']);
    Route::get('/{id}', [QuestionController::class , 'edit']);
    Route::post('/create' ,[QuestionController::class , 'store']);
    Route::delete('/delete/{id}' ,[QuestionController::class , 'delete']);
    Route::put('/update/{id}' ,[QuestionController::class , 'update']);
});

// route tasks
Route::group([ 
    'prefix' => 'tasks'
], function(){
    Route::get('/' , [TaskController::class , 'index']);
    Route::put('/update/{id}' , [TaskController::class , 'updatetask']);
    Route::post('/createtask' , [TaskController::class , 'create']);
});

// route tasksitem
Route::group([ 
    'prefix' => 'taskitem'
], function(){
    Route::get('/', [TaskItemController::class, 'storeTaskTtem']);
    Route::delete('/delete/{id}' , [TaskItemController::class,'delete']);
    Route::put('/update/{id}' , [TaskItemController::class, 'update']);
    Route::post('/create/{id}' , [TaskItemController::class , 'createTaskItem']);
});

// route users
Route::group([
    'prefix' => 'users'
], function(){
    Route::get('/' , [UserController::class,'getUsers']);
    Route::delete('/delete/{id}' , [UserController::class , 'deleteUser']);
    Route::post('/create' , [UserController::class , 'createUser']);
    Route::put('/update/{id}' , [UserController::class , 'updateUser']);
});

// route manager 
Route::group([
    'prefix' => 'project'
],function(){
    Route::get('/' , [ProjectManagerController::class , 'index']);
    Route::post('/create' , [ProjectManagerController::class , 'createProject']);
    Route::put('/update/{id}' , [ProjectManagerController::class , 'updateProject']);
    Route::delete('/delete/{id}' , [ProjectManagerController::class , 'deleteProject']);
});

Route::group([
    'prefix' => 'upload'
] , function(){
    Route::post('/', [FileController::class , 'uploadImage']);
});