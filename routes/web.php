<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

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

// create group of route
//Route::middleware('auth')->group(function(){

    // * the function write on controller
    //resource controller bind all into one
    //php artisan make:controller TodoResourceController --resourc
    //Route::resource('/todo','TodoController')->middleware('auth');
    
    Route::resource('/todo','TodoController');
    // Route::get('/todos','TodoController@index')->name('todo.index');
    // Route::get('/todos/create','TodoController@create');
    // Route::post('/todos/create','TodoController@store');
    // Route::get('/todos/{todo}/edit','TodoController@edit');
    // Route::patch('/todos/{todo}/update','TodoController@update')->name('todo.update');
    // Route::delete('/todos/{todo}/delete','TodoController@delete')->name('todo.delete');
    Route::put('/todos/{todo}/complete','TodoController@complete')->name('todo.complete');
    Route::delete('/todos/{todo}/incomplete','TodoController@incomplete')->name('todo.incomplete');
//});

Route::get('/', function () {
    // return env('APP_NAME');
     return view('welcome');
    //return View::make('welcome'); //aliases
    //return config('services.ses.key'); // get key was setup on .env , \config\services.php
});

Route::get('/user', 'UserController@index');
//UserController@index , index is a function

//simple example had move to user controller
// Route::post('/upload',function(Request $request){
//     //dd($request->all());   //request display all value
//     //dd($request->file('image')); //request get by name
//     //dd($request->image);
//     $request->image->store('images','public');
//     return 'uploaded!!';
//     //dd($request->hasFile('image'));
// });
Route::post('/upload','UserController@uploadAvatar');   // call from UserCOntroller.php 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
