<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('ui.jadwal');
});

Route::view('/jadwal-service', 'ui-jadwal-service')->name('ui.jadwal');
Route::view('/user-staff', 'ui-user-staff')->name('ui.users');
