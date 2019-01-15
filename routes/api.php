<?php

//Employee
Route::get('/employees', 'API\Employee\EmployeeController@index');
Route::post('/employees', 'API\Employee\EmployeeController@store');
Route::get('/employees/{employee}', 'API\Employee\EmployeeController@show');

//Departments
Route::get('/departments', 'API\Employee\EmployeeController@departments');
Route::get('/staffpositions', 'API\Employee\EmployeeController@staffPositions');
