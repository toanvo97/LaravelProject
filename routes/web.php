<?php

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\AuthorityController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home','HomeController@home')->name('admin.home');

Route::prefix('/admin/users')->group(function(){
    Route::get('/list',[UserController::class,'list'])->name('users.list');
    Route::get('/create',[UserController::class,'create'])->name('users.get_create');
    Route::post('/create',[UserController::class,'store'])->name('users.post_create');
    Route::get('/edit/{id}',[UserController::class,'edit'])->name('users.get_edit');
    Route::post('/edit/{id}',[UserController::class,'update'])->name('users.post_edit');
    Route::get('/delete/{id}',[UserController::class,'delete'])->name('users.delete');
    Route::get('/search',[UserController::class,'search'])->name('users.search');
});

Route::prefix('/admin/authorities')->group(function(){
    Route::get('/list',[AuthorityController::class,'list'])->name('authorities.list');
    Route::get('/create',[AuthorityController::class,'create'])->name('authorities.get_create');
    Route::post('/create',[AuthorityController::class,'store'])->name('authorities.post_create');
    Route::get('/edit/{id}',[AuthorityController::class,'edit'])->name('authorities.get_edit');
    Route::post('/edit/{id}',[AuthorityController::class,'update'])->name('authorities.post_edit');
    Route::get('/delete/{id}',[AuthorityController::class,'delete'])->name('authorities.delete');
});


