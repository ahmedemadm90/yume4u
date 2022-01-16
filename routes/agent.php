<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Auth;
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

######################### Begin  Agents Routes  ########################
/* Start Agent Routes */

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'UserController@login')->name('member.login');
    Route::post('login', 'UserController@dologin')->name('member.dologin');
});
Route::group(['prefix' => 'agent', 'middleware' => 'auth,agent'], function () {

    Route::get('/register', 'AgentController@create')->name('agent.register');
    Route::post('/register', 'AgentController@store')->name('agent.store');
    Route::get('/login', 'AgentController@login')->name('agent.login');
    Route::post('/login', 'AgentController@dologin')->name('agent.dologin');
    Route::get('/dashboard', 'AgentController@dashboard')->name('agent.dashboard');
    Route::get('/profile/{id}', 'AgentController@profile')->name('agent.profile');
    Route::get('/agents', 'AgentController@agents')->name('recharge');
    Route::get('/edit/{id}', 'AgentController@edit')->name('agent.edit.myinfo');
    Route::post('/edit/{id}', 'AgentController@update')->name('agent.update.myinfo');

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductsController::class, 'agentIndex'])->name('agent.products');
        Route::get('/create', [ProductsController::class, 'agentProductCreate'])->name('agent.products.create');
        Route::post('/store', [ProductsController::class, 'agentProductStore'])->name('agent.products.store');
    });
    Route::group(['prefix' => 'recharge'], function () {
        Route::get('/log', [TransactionController::class, 'log'])->name('agent.user.log');
        Route::get('/pinding', [TransactionController::class, 'pindding'])->name('agent.charges');
        Route::get('/charge', [TransactionController::class, 'charge'])->name('agent.user.charge');
        Route::post('/charge', [TransactionController::class, 'confirm'])->name('agent.user.confirm');
    });
});