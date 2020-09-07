
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EditorController@index')->name('editor');

Route::get('/post', 'PostController@index')->name('post.index');
Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post/store', 'PostController@store')->name('post.store');

Route::get('/category', 'PostCategoryController@index')->name('postcategory.index');
Route::get('/category/create', 'PostCategoryController@create')->name('postcategory.create');
Route::post('/category/store', 'PostCategoryController@store')->name('postcategory.store');
