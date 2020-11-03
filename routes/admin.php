<?php

// Prefix -> admin
Route::get('/', 'AdminController@index')->name('admin');

Route::get('/users', 'AdminController@users')->name('admin.users');
Route::get('/user/create', 'AdminController@user_create')->name('admin.user.create');
Route::put('/user/store', 'AdminController@user_store')->name('admin.user.store');
Route::get('/user/edit/{id}', 'AdminController@user_edit')->name('admin.user.edit');
Route::put('/user/update/{id}', 'AdminController@user_update')->name('admin.user.update');

Route::get('/categories', 'PostCategoryController@cat_index')->name('admin.categories');
Route::get('/categories/create', 'PostCategoryController@cat_create')->name('admin.categories.create');
Route::put('/categories/store', 'PostCategoryController@cat_store')->name('admin.categories.store');
Route::get('/categories/edit/{id}', 'PostCategoryController@cat_edit')->name('admin.categories.edit');
Route::put('/categories/update/{id}', 'PostCategoryController@cat_update')->name('admin.categories.update');
Route::put('/categories/delete/{id}', 'PostCategoryController@cat_delete')->name('admin.categories.delete');
