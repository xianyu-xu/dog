<?php


Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {

    Route::get('phone','UserController@phone')->name('user.phone');
    Route::post('register','UserController@register')->name('user.register');

});