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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::group(['middleware' => 'remoteAuth'] , function() {
    
    Route::get('/', function() {
        // $category_name = '';
        $data = [
            'category_name' => 'dashboard',
            'page_name' => 'Dashboard',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        // $pageName = 'sales';
        return view('dashboard')->with($data);
    })->name('home');


    // Pages
    Route::prefix('pages')->group(function () {
        Route::get('/coming_soon', function() {
            // $category_name = '';
            $data = [
                'category_name' => 'pages',
                'page_name' => 'coming_soon',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

            ];
            // $pageName = 'coming_soon';
            return view('pages.pages.pages_coming_soon')->with($data);
        });
       
        Route::get('/error_404', function() {
            // $category_name = '';
            $data = [
                'category_name' => 'pages',
                'page_name' => 'error404',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

            ];
            // $pageName = 'error404';
            return view('pages.pages.pages_error404')->with($data);
        });
        Route::get('/error_500', function() {
            // $category_name = '';
            $data = [
                'category_name' => 'pages',
                'page_name' => 'error500',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

            ];
            // $pageName = 'error500';
            return view('pages.pages.pages_error500')->with($data);
        });
        Route::get('/error_503', function() {
            // $category_name = '';
            $data = [
                'category_name' => 'pages',
                'page_name' => 'error503',
                'has_scrollspy' => 0,
                'scrollspy_offset' => '',

            ];
            // $pageName = 'error503';
            return view('pages.pages.pages_error503')->with($data);
        });
    });
});

// Auth::routes();

// Route::get('/', 'HomeController@index');

Route::get('/sign-up', 'Auth\RegisterController@showRegistrationForm')->name('register');   //RegisterForm
Route::post('/sign-up', 'Auth\RegisterController@apiRegister')->name('api-register');

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');  //Login Form
Route::post('/login', 'Auth\LoginController@apiLogin')->name('api-login');

Route::post('/logout', 'Auth\LoginController@apiLogout')->name('api-logout');  //Logout 

Route::get('/password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request'); //SendLinkForm
Route::post('/password/email', 'Auth\ForgotPasswordController@apisendResetLinkEmail')->name('api-password.email');

Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset'); //reset password form
Route::post('/password/reset', 'Auth\ResetPasswordController@updatePass')->name('api-password.update');


Route::get('/system', 'UserActionApiController@viewSystem')->name('api-system');    //Load Cutomers Data
Route::get('/new-system', 'PagesController@newSystem')->name('new-system');    
Route::get('/template', 'PagesController@template')->name('template');

Route::post('/new-system-store', 'UserActionApiController@newSystem')->name('store-system'); //Store new Customer Data in Session
Route::post('/new-system-template', 'UserActionApiController@storeSystem')->name('api-store-template'); //Store in DB

Route::get('/history', 'UserActionApiController@viewHistory')->name('api-history');

Route::get('/general-config','FamilyController@getAllFamilyWithAddons');
Route::post('/addon-save','UserAddonController@store')->name('api-saveAddon');
Route::post('/language-currency-save','UserActionApiController@saveLanguageCurrency')->name('api-language-currency');
