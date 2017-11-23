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
    return view('home');
});
Route::get('/deal/createbyvalue', function () {
        return view('deals/transacao_def');
    });
Route::get('/deal/createbygoal', function () {
        return view('deals/transacao_def');
    });
/*
Route::get('/goals', function () {
    return view('evento_list');
});

Route::get('/goals/create', function () {
    return view('evento_list');
});
*/

Route::resource('home','HomeController');

Route::resource('deal','DealsController');

Route::resource('goals','GoalsController');

Route::resource('achieve','RulesToAchievesController');

Route::resource('awards','RulesToAwardsController');

Route::resource('restricts','RulesToRestrictsController');

Route::resource('customers','CustomerController');
Route::resource('prizes', 'PrizesController');

//Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
