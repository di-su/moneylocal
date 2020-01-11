<?php

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

// Loads homepages
Route::get('/home', 'HomeController@index')->name('home');

// Add income
Route::post('/home/income/store', 'IncomeController@store')->name('income.store');

// Edit
Route::patch('/home/income/update', 'IncomeController@update')->name('income.update');

// Add expense
Route::post('/home/expense', 'ExpensesController@store');
