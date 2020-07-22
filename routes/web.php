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


// get form to create new city
Route::get('cities','CitiesController@index');
// create a city
Route::post('POST/api/cities', ["as" => 'city.create', 'uses' => 'citiesController@store']);

// get form to create new attach city to deleveries
Route::get('city/{city_id}/delevery/create',['as'=>'delivery.attach','uses'=>'CitiesController@attachDelevery']);

// attach deleveries times to a city
Route::post('POST/api/cities/{city_id}/delivery-times', ["as" => 'city.attachDelevery', 'uses' => 'CitiesController@storeDeleveries']);

// get form to create new delevery
Route::get('delevery','DeleveryTimesController@index');

// store the value of new delevery
Route::post('POST/api/delivery-times', ["as" => 'delevery.create', 'uses' => 'DeleveryTimesController@store']);

// change status of one delevery of a city
Route::get('city/{city_id}/delevery/{delevery_id}/{status}', ["as" => 'city.delevery.update', 'uses' => 'CitiesController@cityDeleveryStatus']);

// change status for all delevries times for a city
Route::get('city/{city_id}/delevery/{status}', ["as" => 'city.delevery.cngAll', 'uses' => 'CitiesController@chanageDeleveriesStatus']);

// add new order

// create new order
Route::get('order/new','OrderController@formCheck');

// return the delevey times for a order
Route::get('orders/getDlvTimes/{date}/city/{city_id}','OrderController@checkOrder');

// get our cities
route::get('cities/get','CitiesController@ourCities');


// return iour available  times of a city
Route::get('GET/api/cities/{city_id}/delivery-dates-times/{date}','OrderController@checkOrder');

