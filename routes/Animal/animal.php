<?php

Route::group(['prefix' => 'animal', 'namespace' => 'Animal'], function () {

    Route::post('add','AnimalController@animal_add')->name('animal.add');
    Route::post('getinfo','AnimalController@animal_getinfo')->name('animal.animal_getinfo');
});