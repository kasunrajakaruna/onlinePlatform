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

Route::get('/', 'web\DashboardController@index')->name('dashboard');
Route::post('/login', 'web\DashboardController@login')->name('login');
Route::get('/logout', 'web\DashboardController@logout')->name('logout');

//customer actions
Route::post('/saveTicket', 'web\TicketController@saveTicket')->name('save_ticket');
Route::get('/customer_search_ticket', 'web\TicketController@searchTicketByCustomer')->name('customer_search_ticket');

//support agent
// Route::group(['middleware' => ['auth.user']], function () {

    Route::get('/ticket_list', 'web\TicketController@getTicketList')->name('ticket_list');
    Route::get('/agent_search_ticket', 'web\TicketController@searchTicketByAgent')->name('agent_search_ticket');
    Route::get('/open_ticket', 'web\TicketController@getOpenTicketView')->name('open_ticket');
    Route::post('/save_reply', 'web\TicketController@saveReply')->name('save_reply');

    //admin
    Route::get('/getUserList', 'web\DashboardController@getUserList')->name('user_list');
    Route::post('/saveAgent', 'web\DashboardController@saveAgent')->name('save_agent');

// });