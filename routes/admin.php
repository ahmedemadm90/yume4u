<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\LotteriesController;
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

Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('site'));
})->name('admin.logout');

define('PAGINATION_COUNT', 10);
Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    Route::group(['prefix' => 'lottery/winner'], function () {
        Route::get('upload/image', [LotteriesController::class, 'winnerImageForm'])->name('admin.winner.image');
        Route::post('upload/image', [LotteriesController::class, 'winnerImageUpload'])->name('admin.winner.imageupload');
    });


    ######################### Begin Languages Route ########################
    Route::group(['prefix' => 'languages'], function () {
        Route::get('/', 'LanguagesController@index')->name('admin.languages');
        Route::get('create', 'LanguagesController@create')->name('admin.languages.create');
        Route::post('store', 'LanguagesController@store')->name('admin.languages.store');

        Route::get('edit/{id}', 'LanguagesController@edit')->name('admin.languages.edit');
        Route::post('update/{id}', 'LanguagesController@update')->name('admin.languages.update');

        Route::get('delete/{id}', 'LanguagesController@destroy')->name('admin.languages.delete');
    });
    ######################### End Languages Route ########################
    ######################### Start Reports Route ########################
    Route::group(['prefix' => 'reports'], function () {
        Route::get('products/active', [ReportsController::class, 'ActiveProducts'])->name('ActiveProducts.reports');
        Route::get('products/disabled', [ReportsController::class, 'DisabledProducts'])->name('DisabledProducts.reports');
        Route::get('lotteries/active', [ReportsController::class, 'ActiveLotteries'])->name('ActiveLotteries.reports');
        Route::get('lotteries/disabled', [ReportsController::class, 'DisabledLotteries'])->name('DisabledLotteries.reports');
        Route::get('users/active', [ReportsController::class, 'ActiveUsers'])->name('ActiveUsers.reports');
        Route::get('users/disabled', [ReportsController::class, 'DisabledUsers'])->name('DisabledUsers.reports');
        Route::get('agents/active', [ReportsController::class, 'ActiveAgents'])->name('ActiveAgents.reports');
        Route::get('agents/disabled', [ReportsController::class, 'DisabledAgents'])->name('DisabledAgents.reports');
    });
    ######################### End Reports Route ##########################


    ######################### Begin Main Categoris Routes ########################
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', 'CategoriesController@index')->name('admin.categories');
        Route::get('create', 'CategoriesController@create')->name('admin.categories.create');
        Route::post('store', 'CategoriesController@store')->name('admin.categories.store');
        Route::get('edit/{id}', 'CategoriesController@edit')->name('admin.categories.edit');
        Route::post('update/{id}', 'CategoriesController@update')->name('admin.categories.update');
        Route::get('delete/{id}', 'CategoriesController@destroy')->name('admin.categories.delete');
        Route::get('changeStatus/{id}', 'CategoriesController@changeStatus')->name('admin.categories.status');
    });
    ######################### End  Main Categoris Routes  ########################


    ######################### Begin Sub Categoris Routes ########################
    Route::group(['prefix' => 'sub_categories'], function () {
        Route::get('/', 'SubCategoriesController@index')->name('admin.subcategories');
        Route::get('create', 'SubCategoriesController@create')->name('admin.subcategories.create');
        Route::post('store', 'SubCategoriesController@store')->name('admin.subcategories.store');
        Route::get('edit/{id}', 'SubCategoriesController@edit')->name('admin.subcategories.edit');
        Route::post('update/{id}', 'SubCategoriesController@update')->name('admin.subcategories.update');
        Route::get('delete/{id}', 'SubCategoriesController@destroy')->name('admin.subcategories.delete');
        Route::get('changeStatus/{id}', 'SubCategoriesController@changeStatus')->name('admin.subcategories.status');
    });
    ######################### End  Sub Categoris Routes  ################################################# Begin Sub Categoris Routes ########################

    ######################### Start Transactions Routes  ################################################# Begin Sub Categoris Routes ########################
    Route::group(['prefix' => 'transactions'], function () {
        Route::get('/log', 'AdminsContoller@transactionsLog')->name('admin.transactions.log');
    });
    Route::group(['prefix' => 'recharge'], function () {
        Route::get('/log', [AdminsController::class, 'log'])->name('admin.user.log');
        Route::get('/pinding', [AdminsController::class, 'pindding'])->name('admin.charges');
        Route::get('/charge', [AdminsController::class, 'charge'])->name('admin.user.charge');
        Route::post('/charge', [AdminsController::class, 'confirm'])->name('admin.user.confirm');
        Route::get('/alltransactions', [AdminsController::class, 'agentTransactions'])->name('admin.agent.transactions.log');
        Route::any('/settel/{id}', [AdminsController::class, 'changeState'])->name('admin.transaction.changestate');
    });
    ######################### End  Transactions Routes  ########################

    ######################### Begin Products Routes ########################
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductsController@index')->name('admin.products');
        Route::get('create', 'ProductsController@create')->name('admin.products.create');
        Route::post('store', 'ProductsController@store')->name('admin.products.store');
        Route::get('edit/{id}', 'ProductsController@edit')->name('admin.products.edit');
        Route::post('update/{id}', 'ProductsController@update')->name('admin.products.update');
        Route::get('delete/{id}', 'ProductsController@destroy')->name('admin.products.delete');
    });
    ######################### End  Products Routes  ########################


    ######################### Begin Lottaries Routes ########################
    Route::group(['prefix' => 'lotteries'], function () {
        Route::get('/', 'LotteriesController@index')->name('admin.lotteries');
        Route::get('create', 'LotteriesController@create')->name('admin.lotteries.create');
        Route::post('store', 'LotteriesController@store')->name('admin.lotteries.store');
        Route::get('edit/{id}', 'LotteriesController@edit')->name('admin.lotteries.edit');
        Route::post('update/{id}', 'LotteriesController@update')->name('admin.lotteries.update');
        Route::get('delete/{id}', 'LotteriesController@destroy')->name('admin.lotteries.delete');
    });
    ######################### End  Lottaries Routes  ########################



    ######################### Begin Roles Routes ########################
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'RoleController@index')->name('admin.roles');
        Route::get('create', 'RoleController@create')->name('admin.roles.create');
        Route::post('store', 'RoleController@store')->name('admin.roles.store');
        Route::get('edit/{id}', 'RoleController@edit')->name('admin.roles.edit');
        Route::post('update/{id}', 'RoleController@update')->name('admin.roles.update');
        Route::get('delete/{id}', 'RoleController@destroy')->name('admin.roles.delete');
    });
    ######################### End  Roles Routes  ########################

    ######################### Begin Agents Routes ########################
    Route::group(['prefix' => 'agents'], function () {
        Route::get('/', [AgentController::class, 'index'])->name('admin.agents');
        Route::get('/create', [AgentController::class, 'agentCreate'])->name('admin.agents.create');
        Route::post('/store', [AgentController::class, 'agentStore'])->name('admin.agents.store');
        Route::get('/edit/{id}', [AgentController::class, 'agentEdit'])->name('admin.agents.edit');
        Route::post('/update/{id}', [AgentController::class, 'agentUpdate'])->name('admin.agents.update');
        Route::get('/show/{id}', [AgentController::class, 'show'])->name('admin.agents.show');
        Route::get('changeStatus/{id}', [AgentController::class, 'changeStatus'])->name('admin.agents.status');
        Route::get('requests', [AgentController::class, 'requests'])->name('admin.agents.requests');
    });
    ######################### End  USERS Routes  ########################


    ######################### Begin USERS Routes ########################
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.users');
        Route::get('/create', 'UserController@create')->name('admin.users.create');
        Route::post('/store', 'UserController@store')->name('admin.users.store');
        Route::get('edit/{id}', 'UserController@edit')->name('admin.users.edit');
        Route::post('update/{id}', 'UserController@update')->name('admin.users.update');
        Route::get('delete/{id}', 'UserController@destroy')->name('admin.users.delete');
    });
    ######################### End  USERS Routes  ########################


});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/edit/{id}', 'AdminsController@editInfo')->name('admin.edit.myinfo');
    Route::post('/edit/{id}', 'AdminsController@updateInfo')->name('admin.update.myinfo');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //Route::group(['namespace' => 'admin', 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.admin.login');
    Route::post('login', 'LoginController@login')->name('admin.login');
});


 ########################### test part routes #####################

/* Route::get('subcateory',function (){

      $mainCategory = \App\Models\MainCategory::find(31);

   return       $mainCategory -> subCategories;
});

Route::get('maincategory',function (){

    $subcategory = \App\Models\SubCategory::find(1);

    return $subcategory -> mainCategory;


}); */