<?php

Route::get('/employees/', 'API\Employee\EmployeeController@index');
Route::get('/employees/{employee}', 'API\Employee\EmployeeController@show');