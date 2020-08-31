
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EditorController@index')->name('editor');

Route::get('/post', 'PostController@index')->name('post.index');
