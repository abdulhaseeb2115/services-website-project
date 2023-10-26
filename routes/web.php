<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\Verification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ADMIN ROUTES
Route::get('/settings', function () {
    return view('admin.settings');
});

Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard');

Route::get('/requests', 'App\Http\Controllers\AdminController@requests');
Route::post('/cancelRequest', 'App\Http\Controllers\AdminController@cancelRequest');
Route::post('/approveRequest', 'App\Http\Controllers\AdminController@approveRequest');

Route::get('/feedbacks', 'App\Http\Controllers\AdminController@feedbacks');
Route::get('/category', 'App\Http\Controllers\AdminController@category');
Route::post('/addCategory', 'App\Http\Controllers\AdminController@addCategory');
Route::get('/workers', 'App\Http\Controllers\AdminController@workers');
Route::post('/addWorker', 'App\Http\Controllers\AdminController@addWorker');
Route::get('/getWorker', 'App\Http\Controllers\AdminController@getWorker');



// WORKER ROUTES
Route::get('/worker/settings', function () {
    return view('worker.settings');
});


Route::get('/worker/login', 'App\Http\Controllers\WorkerController@loginPage');
Route::post('/workerLogin', 'App\Http\Controllers\WorkerController@login');
Route::post('/workerRegister', 'App\Http\Controllers\WorkerController@register');

Route::get('/worker/dashboard', 'App\Http\Controllers\WorkerController@dashboard');
Route::get('/worker/history', 'App\Http\Controllers\WorkerController@history');
Route::get('/worker/logout', 'App\Http\Controllers\WorkerController@logout');




// USER ROUTES
Route::get('/user/login', function () {
    return view('user.login');
});


Route::get('/user/login', 'App\Http\Controllers\UserController@loginPage');
Route::post('/userLogin', 'App\Http\Controllers\UserController@login');
Route::post('/userRegister', 'App\Http\Controllers\UserController@register');

Route::get('/user/dashboard', 'App\Http\Controllers\UserController@dashboard');
Route::post('/userAddFeedback', 'App\Http\Controllers\UserController@addFeedback');

Route::get('/user/request', 'App\Http\Controllers\UserController@requestPage');
Route::post('/addRequest', 'App\Http\Controllers\UserController@addRequest');

Route::get('/user/history', 'App\Http\Controllers\UserController@history');
Route::get('/user/logout', 'App\Http\Controllers\UserController@logout');
