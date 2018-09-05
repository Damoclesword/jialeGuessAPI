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
});

//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/clients', 'ClientsController@root')->name('admin.clients.root');

    Route::get('/teams', 'TeamsController@root')->name('admin.teams.root');
    Route::delete('/teams/delete/{id}', 'TeamsController@delete')->name('admin.teams.delete');
    Route::post('/teams/create', 'TeamsController@create')->name('admin.teams.create');
    Route::delete('/teams/destroy','TeamsController@destroy')->name('admin.teams.destroy');

    Route::get('/configs', 'ConfigsController@root')->name('admin.configs.root');
    Route::put('/configs/update', 'ConfigsController@update')->name('admin.configs.update');

    Route::post('/guess/filter', 'GuessesController@filter')->name('admin.guesses.filter');
    Route::delete('/guess/destroy', 'GuessesController@destroy')->name('admin.guesses.destroy');
});
