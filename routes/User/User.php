<?php


Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {

    Route::get('phone','UserController@phone')->name('user.phone');
    Route::post('register','UserController@register')->name('user.register');
    Route::post('getinfo','UserController@getinfo')->name('user.getinfo');
    Route::post('addinfo','UserController@UAdd')->name('user.add');
    Route::get('getcontent','UserController@getUContent')->name('user.getcontent');
    Route::post('thingsadd','TimeThingsController@add')->name('user.thingsadd');
    Route::get('getThings','TimeThingsController@getThings')->name('user.getThings');
    Route::get('getThing','TimeThingsController@getThing')->name('user.getThing');
    Route::get('delThing','TimeThingsController@delThing')->name('user.delThing');
});
