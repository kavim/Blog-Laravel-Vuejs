<?php

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

// Authentication Routes...
// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
//     return redirect('web/');
// });

// Route::get('/{any}', 'SpaController@index')->where('any', '.*');

// Route::group(['prefix' => 'web'], function () {
    Route::get('/{vue_capture?}', 'SpaController@index')->where('vue_capture', '[\/\w\.-]*');
// });

// Route::get('/{vue_capture?}', 'SpaController@index')->where('vue_capture', '[\/\w\.-]*');

// Route to handle page reload in Vue except for api routes
// Route::get('/{any?}', function (){
//     return view('welcome');
// })->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/vue/{vue_capture?}', function () {
//     return view('vue.index');
//    })->where('vue_capture', '[\/\w\.-]*');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
