<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->namespace('Backend')->middleware('auth:admin_user')->group(function() {
    Route::get('/', 'PageController@index')->name('home');

    Route::resource('admin-user', 'AdminUserController');
    Route::get('admin-user/datatable/ssd', 'AdminUserController@ssd')->name('datatables.data');

    Route::resource('user', 'UserController');
    Route::get('user/datatable/ssd', 'UserController@ssd')->name('datatables.data');

    Route::get('wallet', 'WalletController@index')->name('wallet.index');
    Route::get('wallet/datatable/ssd', 'WalletController@ssd');
});

