<?php

// Prefix -> admin
Route::get('/', 'AdminController@index')->name('admin');

Route::get('/users', 'AdminController@users')->name('admin.users');
Route::get('/user/edit/{id}', 'AdminController@user_edit')->name('admin.user.edit');
Route::get('/user/update/{id}', 'AdminController@user_update')->name('admin.user.update');
