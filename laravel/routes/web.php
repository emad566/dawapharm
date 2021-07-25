<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
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



Auth::routes();


// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::group(['middleware' => ['auth', 'isSupperAdmin']], function () {

    Route::resource('pharm/currentmonth', 'currentmonthController');
    Route::resource('pharm/offer', 'offerController');
    Route::resource('pharm/product', 'productController');
    Route::resource('pharm/role', 'RoleController');
    // Route::get('/home', 'HomeController@index')->name('home');


});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/home', function () {
        return view('index');
    });
    Route::resource('pharm/customer', 'customerController');
});

Route::post('/createcustomer', 'customerController@store');
Route::get('/{offer_id?}', 'customerController@create');
//return to home if require to register new user without loged in
