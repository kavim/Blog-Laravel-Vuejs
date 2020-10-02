
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EditorController@index')->name('editor');

Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');
Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::put('/post/update/{id}', 'PostController@update')->name('post.update');

Route::get('/post/manager/{id?}', 'PostController@manager');
Route::post('/post/save', 'PostController@save');

Route::get('/category', 'PostCategoryController@index')->name('postcategory.index');
Route::get('/category/create', 'PostCategoryController@create')->name('postcategory.create');
Route::post('/category/store', 'PostCategoryController@store')->name('postcategory.store');
Route::get('/category/edit/{id}', 'PostCategoryController@edit')->name('postcategory.edit');
Route::post('/category/update/{id}', 'PostCategoryController@update')->name('postcategory.update');

Route::get('/profile', 'UserController@profile')->name('profile');
Route::get('/profile/edit', 'UserController@profile_edit')->name('profile.edit');
Route::put('/profile/update', 'UserController@profile_update')->name('profile.update');
