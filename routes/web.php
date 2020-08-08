<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

$router->get('/', 'WelcomeController@index');

$router->group(['prefix' => 'employees'], function () use ($router) {
    $router->get('/', 'EmployeesController@list');
    $router->get('/count', 'EmployeesController@count');
    $router->get('/one', 'EmployeesController@getOne');
    $router->get('/{id}', 'EmployeesController@get');
    $router->post('/', 'EmployeesController@create');
    $router->put('/{id}', 'EmployeesController@update');
    $router->delete('/{id}', 'EmployeesController@delete');
});

$router->group(['prefix' => 'statistics'], function () use ($router) {
    $router->get('/top-paid-employees', 'StatisticsController@topPaidEmployees');
    $router->get('/average-salary-by-age', 'StatisticsController@averageSalaryByAge');
});
