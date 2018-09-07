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
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


Route::get('customers/', 'CustomersController@index')->name('customers');
Route::get('customers/{customer}/edit', 'CustomersController@edit')->name('customers.edit');
Route::get('add',function(){return view('add');});
Route::post('add','CustomersController@add');
Route::post('customers/','CustomersController@manipulate');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
