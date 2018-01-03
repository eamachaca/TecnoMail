<?php

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
})->middleware('guest');

Auth::routes();


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => 'user'], function () {
    // Routes Within The "auth" middleware
    Route::get('mail', [
        'as' => 'mail',
        'uses' => 'HomeController@mail'
    ]);

    Route::resource('folder', 'FolderController', ['only' => [
        'index', 'store'
    ]]);

    Route::get('roster/{id}', [
        'as' => 'roster.show',
        'uses' => 'RosterController@show'
    ]);

    Route::post('roster', [
        'as' => 'roster.store',
        'uses' => 'RosterController@store'
    ]);

    Route::get('compose', [
        'as' => 'compose',
        'uses' => 'HomeController@compose'
    ]);

    Route::get('view', [
        'as' => 'view',
        'uses' => 'HomeController@view'
    ]);

    Route::post('compose', [
        'as' => 'send',
        'uses' => 'HomeController@send'
    ]);
});
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {
    Route::get('mail', [
        'as' => 'admin.mail',
        'uses' => 'MailController@index'
    ]);

    Route::get('user', [
        'as' => 'admin.users.index',
        'uses' => 'MailController@users'
    ]);


    Route::get('count', [
        'as' => 'admin.counts.index',
        'uses' => 'MailController@counts'
    ]);
    Route::get('count/{id}', [
        'as' => 'admin.counts.show',
        'uses' => 'MailController@count'
    ]);

    Route::get('user/{id}', [
        'as' => 'admin.users.show',
        'uses' => 'MailController@user'
    ]);
});
//Route::get('/home', 'HomeController@index')->name('home');

/*// Authentication routes...
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => 'login-post',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);
// Registration routes...
Route::get('register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
    'as' => 'register-post',
    'uses' => 'Auth\RegisterController@register'
]);
Route::get('password/reset/{token}', [
    'as' => 'password.reset',
    'uses' => 'Auth\ResetPasswordController@showResetForm'
]);
Route::get('password/reset', [
    'as' => 'password.request',
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::post('password/reset', [
    'as' => 'password.reset-post',
    'uses' => 'Auth\ResetPasswordController@reset'
]);
*/