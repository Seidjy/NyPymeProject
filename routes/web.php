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
Route::get('/deal/createbyGoal', 'DealsController@createbyGoal');

Route::post('/deal/storebyGoal', 'DealsController@storebyGoal');

Route::get('/deal/debit', 'DealsController@debit');

Route::post('/deal/storeDebit', 'DealsController@storeDebit');

Route::get('/goals/{id}/editar', 'GoalsController@edit');

Route::post('/goals/{id}/update', 'GoalsController@update');

Route::post('/prize/{id}/update', 'PrizesController@update');

Route::get('/prize/{id}/editar', 'PrizesController@edit');

Route::post('/participant/{id}/update', 'CustomerController@update');

Route::get('/participant/{id}/editar', 'CustomerController@edit');



Route::get('/log/login', 'LogsController@logLogin');

Route::get('/log/login/sucesso', 'LogsController@logLoginSuccess');

Route::get('/log/login/insucesso', 'LogsController@logLoginNotSuccess');

Route::get('/log/premios', 'LogsController@logPrize');

Route::post('/log/premios/data', 'LogsController@logPrizeDate');

Route::get('/log/participant', 'LogsController@logParticipant');

Route::post('/log/participant/data', 'LogsController@logParticipantDate');

Route::get('/log/bloqueados', 'LogsController@usersBlocked');

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


