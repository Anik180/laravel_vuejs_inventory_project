<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/customer','Api\CustomerController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');

Route::Post('/salary/paid/{id}','SalaryController@Paid');
Route::Get('/salary','SalaryController@Allsalary');
Route::Get('/salary/view/{id}','SalaryController@salaryview');
Route::Get('/edit/salary/{id}','SalaryController@EditSalary');
Route::Post('/salary/update/{id}','SalaryController@SalaryUpdate');
Route::Post('/stock/update/{id}','SalaryController@stockUpdate');

Route::Get('/pos','PosController@Allpos');