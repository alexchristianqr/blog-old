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

Route::group(['middleware' => ['checkIsActive', 'auth']], function () {

    //CMS HOME
    Route::get('cms/home', 'CmsController@cmsHome');

    // CMS POST
    Route::get('cms/posts', 'CmsController@cmsPosts');
    Route::get('cms/post', 'CmsController@cmsPost');
    Route::post('cms/store-post', 'CmsController@cmsStorePost');
    Route::get('cms/edit-post/{id}', 'CmsController@cmsEditPost');
    Route::put('cms/update-post/{id}', 'CmsController@cmsUpdatePost');
    Route::put('cms/post/change-state', 'CmsController@cmsChangeStatePost');
    Route::get('cms/preview/{id}', 'CmsController@cmsPreview');

    // CMS USER
    Route::get('cms/users', 'CmsController@cmsUsers');
    Route::get('cms/user', 'CmsController@cmsUser');
    Route::post('cms/store-user', 'CmsController@cmsStoreUser');
    Route::get('cms/edit-user/{id}', 'CmsController@cmsEditUser');
    Route::put('cms/update-user/{id}', 'CmsController@cmsUpdateUser');

    // CMS TABLES
    Route::get('cms/tables', 'CmsController@cmsTables');
    Route::get('cms/edit-table/{table}/{id}', 'CmsController@cmsEditTable');
    Route::post('cms/store-table', 'CmsController@cmsStoreTable');
    Route::post('cms/update-table/{table}/{id}', 'CmsController@cmsUpdateTable');//put

    // CMS PORTFOLIO
    Route::get('cms/portfolios', 'CmsController@cmsPortfolios');
    Route::get('cms/portfolio', 'CmsController@cmsPortfolio');
    Route::post('cms/store-portfolio', 'CmsController@cmsStorePortfolio');
    Route::get('cms/edit-portfolio/{id}', 'CmsController@cmsEditPortfolio');
    Route::put('cms/update-portfolio/{id}', 'CmsController@cmsUpdatePortfolio');

    // LOGOUT
    Route::get('logout', 'Auth\LoginController@logout');

});

Route::group(['middleware' => ['guest','web']], function () {

    // USER
    Route::get('auth/socialite/{provider}', 'Auth\OAuthController@redirectToProvider')->name('socialite.login');
    Route::get('auth/socialite/callback/{provider}', 'Auth\OAuthController@handleProviderCallback');
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('post_login', 'Auth\LoginController@fnDoLogin');

    Route::get('socialite/register', 'HomeController@socialiteRegister');
    Route::post('socialite/store', 'HomeController@socialiteStore');

    // PASSWORD
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    // MENU
    Route::get('service', 'HomeController@personalService');
    Route::get('profile', 'HomeController@personalProfile');
    Route::get('contact', 'HomeController@personalContact');
    Route::get('portfolio', 'HomeController@personalPortfolio');
    Route::get('/', 'PostController@index');

    // POST
    Route::get('post/show/{id}', 'PostController@show');
    Route::get('search', 'PostController@searchRepositories');
    Route::post('subscription/email', 'PostController@sendMailSubscription');
    Route::get('subscription/confirm/{remember_token}', 'PostController@confirmMailSubscription');
    Route::get('get/counts', 'PostController@getCounts');
    Route::put('update/counts', 'PostController@updateCounts');
    Route::post('send/contact', 'PostController@sendMailContact');

});