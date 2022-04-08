<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\User;

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
Route::get('/admin/home', 'HomeController@home')->name('admin.home')->middleware('guest');
Route::group(['middleware' => 'guest'], function () {

    Route::prefix('/admin/users')->group(function () {
        Route::get('/list', 'admin\UserController@view')->name('users.list')->middleware('can:list-user');
        Route::get('/create', 'admin\UserController@create')->name('users.get_create')->middleware('can:create-user');
        Route::post('/create', 'admin\UserController@store')->name('users.post_create');
        Route::get('/edit/{id}', 'admin\UserController@edit')->name('users.get_edit')->middleware('can:update-user');
        Route::post('/edit/{id}', 'admin\UserController@update')->name('users.post_edit');
        Route::get('/delete/{id}', 'admin\UserController@delete')->name('users.delete')->middleware('can:delete-user');
        Route::get('/search', 'admin\UserController@search')->name('users.search');
        Route::post('/assigned_role', 'admin\UserController@assignedRole')->name('users.assigned_role');
    });

    Route::prefix('/admin/roles')->group(function () {
        Route::get('/list', 'admin\AuthorityController@list')->name('authorities.list')->middleware('can:list-role');
        Route::get('/create', 'admin\AuthorityController@create')->name('authorities.get_create')->middleware('can:create-role');
        Route::post('/create', 'admin\AuthorityController@store')->name('authorities.post_create');
        Route::get('/edit/{id}', 'admin\AuthorityController@edit')->name('authorities.get_edit')->middleware('can:update-role');
        Route::post('/edit/{id}', 'admin\AuthorityController@update')->name('authorities.post_edit');
        Route::get('/delete/{id}', 'admin\AuthorityController@delete')->name('authorities.delete')->middleware('can:delete-role');
        Route::post('/assigned_permission', 'admin\AuthorityController@assignedPermission')->name('authorities.assigned_permission');
    });

    Route::prefix('/admin/permissions')->group(function () {
        Route::get('/list', 'admin\PermissionController@list')->name('permissions.list')->middleware('can:list-permission');
        Route::get('/create', 'admin\PermissionController@create')->name('permissions.get_create')->middleware('can:create-permission');
        Route::post('/create', 'admin\PermissionController@store')->name('permissions.post_create');
        Route::get('/edit/{id}', 'admin\PermissionController@edit')->name('permissions.get_edit')->middleware('can:update-permission');
        Route::post('/edit/{id}', 'admin\PermissionController@update')->name('permissions.post_edit');
        Route::get('/delete/{id}', 'admin\PermissionController@delete')->name('permissions.delete')->middleware('can:delete-permission');
    });

    // Route::prefix('/admin/permissions')->group(function () {
    //     Route::get('/list', 'admin\PermissionController@list')->name('permissions.list')->middleware('can:view');
    //     Route::get('/create', 'admin\PermissionController@create')->name('permissions.get_create')->middleware('can:view');
    //     Route::post('/create', 'admin\PermissionController@store')->name('permissions.post_create');
    //     Route::get('/edit/{id}', 'admin\PermissionController@edit')->name('permissions.get_edit')->middleware('can:view');
    //     Route::post('/edit/{id}', 'admin\PermissionController@update')->name('permissions.post_edit');
    //     Route::get('/delete/{id}', 'admin\PermissionController@delete')->name('permissions.delete')->middleware('can:view');
    // });

    Route::prefix('/admin/generals')->group(function(){
        Route::get('/list',function(){
            return view('fun');
        })->middleware('can:view');
    });
});
