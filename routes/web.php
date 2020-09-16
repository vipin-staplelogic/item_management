<?php
Route::get('/', function () {
	return Redirect::action('TestController@index');
});
Route::get('/manage_items', 'TestController@index')->name('manageItems');
Route::post('/add/item', 'TestController@addItem')->name('addItem');
Route::post('/add/item/left/to/right', 'TestController@swapItems')->name('addItem');