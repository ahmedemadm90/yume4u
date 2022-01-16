<?php

use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\LotteriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Lottery;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User_Lotteries;
use Carbon\Carbon;
use Illuminate\Support\Str;

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

Route::get('/forgot-password', function () {
    return view('auth.passwords.email');
})->middleware('guest')->name('password.request');
Route::get('/password/reset/token={token}', function ($token) {
    return view('auth.passwords.reset-password', compact('token'));
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('site')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/', function () {
    return view('front.home');
})->name('site');
Route::any('/logout', function () {
    Auth::logout();
    return view('auth.login');
})->name('member.logout')->middleware('guest');

Route::any('agent/logout', function () {
    Auth::logout();
    return view('front.agents.login');
})->name('agent.logout')->middleware('guest');

Route::get('/about', function () {
    return view('front.about');
});
Route::get('/contact', function () {
    return view('front.contact');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
######################### Begin Members Routes ########################
Route::get('/register', 'UserController@register')->name('member.register');
Route::post('/store/{id?}', 'UserController@store')->name('member.store');
Route::get('edit/{id}', 'UserController@edit')->name('member.edit');
Route::post('update/{id}', 'UserController@update')->name('member.update');
######################### End Members Routes ########################

######################### Begin Members Routes ########################
Route::get('login', [UserController::class, 'login'])->name('member.login')->middleware('guest');
Route::post('login', [UserController::class, 'dologin'])->name('member.dologin');
Route::get('logout', [UserController::class, 'logout'])->name('member.logout')->middleware('user');

######################### Begin lotteries Routes ########################
Route::group(['prefix' => 'lotteries'], function () {
    Route::get('/', "lotteriesController@index")->name('front.lotteries');
    Route::get('/view/{id}', "lotteriesController@show")->name('front.lotteries.view');
    Route::any('/part/{id}', "lotteriesController@part")->name('front.lotteries.part');
    Route::any('/expire', "lotteriesController@expire")->name('front.lotteries.expired');
});
######################### End lotteries Routes ########################


######################### Begin  Agents Routes  ########################
Route::group(['middleware' => 'guest'], function () {
    Route::get('agent/login', 'AgentController@login')->name('agent.login');
    Route::post('agent/login', 'AgentController@dologin')->name('agent.dologin');
});
Route::group(['prefix' => 'agent', 'middleware' => 'agent'], function () {
    Route::get('/register', 'AgentController@create')->name('agent.register');
    Route::post('/register', 'AgentController@store')->name('agent.store');
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
    Route::group(['prefix' => 'lotteries'], function () {
        Route::get('/expired', 'AgentController@expire')->name('agent.expired.lotteries');
        Route::get('/active', 'AgentController@active')->name('agent.active.lotteries');
    });
});
######################### End  Agents Routes  ########################

######################### Start Users Routes  ########################
Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/edit/{id}', [UserController::class, 'editUser'])->name('user.editInfo');
    Route::post('/edit/{id}', [UserController::class, 'updateUser'])->name('user.updateInfo');

    //Users Transactions Route
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/log/{id}', [UserController::class, 'userlog'])->name('user.transactions.log'); //done
    });
    Route::group(['prefix' => 'lotteries'], function () {
        Route::get('/active/{id}', [UserController::class, 'userActiveLotteries'])->name('user.active.lotteries'); //done
    });
});
######################### End  Users Routes  ########################

######################### Start Front Category Routes  ########################
Route::group(['prefix' => 'categories'], function () {
    Route::get('category/{id}', 'CategoryController@index')->name('front.category');
});
######################### End  Front Category Routes  ########################