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
//navegation routes
Route::get('/home', 'HomeController@index')->name('home');

//index routes
Route::get('/sale/gold', 'SaleController@index');
Route::get('/sale/silver', 'SaleController@index');
Route::get('/sale/diamond', 'SaleController@index');
Route::get('/sale/gemstone', 'SaleController@index');

//Stats routes
Route::post('/sale/gold', 'SaleController@index');
Route::post('/sale/silver', 'SaleController@index');
Route::post('/sale/diamond', 'SaleController@index');
Route::post('/sale/gemstone', 'SaleController@index');

//display form
Route::get('/sale/new/gold', 'SaleController@saleform');
Route::get('/sale/new/silver', 'SaleController@saleform');
Route::get('/sale/new/diamond', 'SaleController@saleform');
Route::get('/sale/new/gemstone', 'SaleController@saleform');

//create routes
Route::post('/sale/new/gold', 'SaleController@create');
Route::post('/sale/new/silver', 'SaleController@create');
Route::post('/sale/new/diamond', 'SaleController@create');
Route::post('/sale/new/gemstone', 'SaleController@create');

//view routes
Route::get('/sale/gold/show/{id}', 'SaleController@show');
Route::get('/sale/silver/show/{id}', 'SaleController@show');
Route::get('/sale/diamond/show/{id}', 'SaleController@show');
Route::get('/sale/gemstone/show/{id}', 'SaleController@show');

//update routes
Route::post('/sale/gold/show/{id}', 'SaleController@update');
Route::post('/sale/silver/show/{id}', 'SaleController@update');
Route::post('/sale/diamond/show/{id}', 'SaleController@update');
Route::post('/sale/gemstone/show/{id}', 'SaleController@update');

//Delete Routes
Route::post('/sale/gold/delete', 'SaleController@delete');
Route::post('/sale/silver/delete', 'SaleController@delete');
Route::post('/sale/diamond/delete', 'SaleController@delete');
Route::post('/sale/gemstone/delete', 'SaleController@delete');


//index routes PURCHASE
Route::get('/purchase/gold', 'PurchaseController@index');
Route::get('/purchase/silver', 'PurchaseController@index');
Route::get('/purchase/diamond', 'PurchaseController@index');
Route::get('/purchase/gemstone', 'PurchaseController@index');

//Stats routes PURCHASE
Route::post('/purchase/gold', 'PurchaseController@index');
Route::post('/purchase/silver', 'PurchaseController@index');
Route::post('/purchase/diamond', 'PurchaseController@index');
Route::post('/purchase/gemstone', 'PurchaseController@index');


//display form PURCHASE
Route::get('/purchase/new/gold', 'PurchaseController@viewform');
Route::get('/purchase/new/silver', 'PurchaseController@viewform');
Route::get('/purchase/new/diamond', 'PurchaseController@viewform');
Route::get('/purchase/new/gemstone', 'PurchaseController@viewform');

// Create Route PURCHASE
Route::post('/purchase/new/gold', 'PurchaseController@create');
Route::post('/purchase/new/silver', 'PurchaseController@create');
Route::post('/purchase/new/diamond', 'PurchaseController@create');
Route::post('/purchase/new/gemstone', 'PurchaseController@create');

//View Routes PURCHASE
Route::get('/purchase/gold/show/{id}', 'PurchaseController@show');
Route::get('/purchase/silver/show/{id}', 'PurchaseController@show');
Route::get('/purchase/diamond/show/{id}', 'PurchaseController@show');
Route::get('/purchase/gemstone/show/{id}', 'PurchaseController@show');

//Update Routes PURCHASE
Route::post('/purchase/gold/show/{id}', 'PurchaseController@update');
Route::post('/purchase/silver/show/{id}', 'PurchaseController@update');
Route::post('/purchase/diamond/show/{id}', 'PurchaseController@update');
Route::post('/purchase/gemstone/show/{id}', 'PurchaseController@update');

//Delete Routes PURCHASE
Route::post('/purchase/gold/delete', 'PurchaseController@delete');
Route::post('/purchase/silver/delete', 'PurchaseController@delete');
Route::post('/purchase/diamond/delete', 'PurchaseController@delete');
Route::post('/purchase/gemstone/delete', 'PurchaseController@delete');


//EXPENSE Routes
Route::get('/expense', 'ExpenseController@index');
Route::post('/expense', 'ExpenseController@index'); //stats

Route::get('/expense/new', 'ExpenseController@viewform'); //display form 
Route::post('/expense/new', 'ExpenseController@create'); //create

Route::get('/expense/show/{id}', 'ExpenseController@show'); //show record
Route::post('/expense/show/{id}', 'ExpenseController@update'); //update record
Route::post('/expense/delete', 'ExpenseController@delete'); //update record




//Manage PARTY Routes
Route::get('/party', 'PartyController@index');
Route::post('/party', 'PartyController@create');
Route::post('/party/delete', 'PartyController@delete');

//Select Branch routs
Route::get('/select/branch/sn', 'HomeController@sel_smritinagar');
Route::get('/select/branch/nn', 'HomeController@sel_nehrunagar');

//Party Select Route
Route::get('/select/party/{id}', 'HomeController@sel_party');

/*
Route::get('/backup', function () {
    Artisan::call('mysql-dump'); 
});
>*/



