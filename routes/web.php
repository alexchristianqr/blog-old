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

//use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {

    //USUARIO
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('cms', function () {
        return view('cms');
    })->name('admin.cms');
    Route::get('admin/home', function () {
        return view('admin.home');
    })->name('admin.home');

    //ADMIN POST
    Route::get('admin/post/index', 'PostController@indexAdmin')->name('admin.post.index');
    Route::get('admin/post/edit', 'PostController@editAdmin')->name('admin.post.edit');
    Route::put('admin/post/update', 'PostController@updateAdmin')->name('admin.post.update');

    //LOGOUT
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

});

//USUARIO
Route::get('auth/socialite/{provider}', 'Auth\OAuthController@redirectToProvider')->name('socialite.login');
Route::get('auth/socialite/callback/{provider}', 'Auth\OAuthController@handleProviderCallback');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@fnDoLogin')->name('post.login');

//PASSWORD
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//PERSONAL
Route::get('personal/service', 'HomeController@personalService');
Route::get('personal/profile', 'HomeController@personalProfile');

//BLOG >> POST
Route::get('post/store', 'PostController@store');
Route::get('post/show/{id}/{tipo_post}', 'PostController@show');
Route::get('/', 'PostController@index');

//OTROS
Route::get('get/html', 'PostController@getHtml');
Route::get('search', 'PostController@searchRepositories');

//PORTAFOLIO
Route::get('portafolio', function () {
    return view('portafolio.index');
});

Route::get('email/suscription','PostController@sendEmailSuscription');

