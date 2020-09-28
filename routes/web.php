<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('employee/show/{id}', 'EmployeeController@show')->name('employee.show')->middleware('auth');
Route::group(['middleware' => ['auth','CheckRole']], function () {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/employee', 'EmployeeController@index')->name('employee');
	Route::delete('employee/destroy/{id}', 'EmployeeController@destroy')->name('employee.destroy');
	Route::get('employee/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
	Route::get('employee/create', 'EmployeeController@create')->name('employee.create');
	Route::post('employee/store', 'EmployeeController@store')->name('employee.store');
	Route::patch('employee/update/{id}', 'EmployeeController@update')->name('employee.update');
	Route::patch('employee/status_change/{id}', 'EmployeeController@status_change')->name('employee.status_change');

});
//Route::resource('employee','EmployeeController');
