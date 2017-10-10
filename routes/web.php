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

Route::group(['middleware' => ['isActive','auth']], function () {

    //USUARIO
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    //CMS
//    Route::get('cms/files', 'CmsController@cmsBrowserFiles');
    Route::post('cms/files', 'CmsController@cmsBrowserFiles');
    Route::get('cms/home', 'CmsController@cmsHome')->name('cms.home');
    Route::get('cms/posts', 'CmsController@cmsPosts');
    Route::get('cms/post', 'CmsController@cmsPost');
    Route::get('cms/tables', 'CmsController@cmsTables');
    Route::get('cms/users', 'CmsController@cmsUsers');
    Route::get('cms/user', 'CmsController@cmsUser');
    Route::get('cms/preview/{id}', 'CmsController@cmsPreview');
    Route::put('cms/post/change-state', 'CmsController@cmsChangeStatePost');
    Route::get('cms/edit-post/{id}', 'CmsController@cmsEditPost');
    Route::get('cms/edit-table/{table}/{id}', 'CmsController@cmsEditTable');
    Route::get('cms/edit-user/{id}', 'CmsController@cmsEditUser');
    Route::post('cms/store-post', 'CmsController@cmsStorePost');
    Route::post('cms/store-table', 'CmsController@cmsStoreTable');
    Route::post('cms/store-user', 'CmsController@cmsStoreUser');
    Route::put('cms/update-post/{id}', 'CmsController@cmsUpdatePost');
    Route::post('cms/update-table/{table}/{id}', 'CmsController@cmsUpdateTable');//put
    Route::put('cms/update-user/{id}', 'CmsController@cmsUpdateUser');//put

//    Route::get('/file', function(){ return redirect('/file/image'); });
//    Route::resource('/file/image', 'CmsController');

    //LOGOUT
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

});

Route::group(['middleware' => ['web']], function () {
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

//BLOG
    Route::get('service', 'HomeController@personalService');
    Route::get('profile', 'HomeController@personalProfile');
    Route::get('contact', 'HomeController@personalContact');
    Route::get('portfolio', 'HomeController@personalPortfolio');
    Route::get('/', 'PostController@index')->name('home');

//POST
    Route::get('post/show/{id}/{id_category}', 'PostController@show');
    Route::get('search', 'PostController@searchRepositories');
    Route::post('subscription/email', 'PostController@sendMailSubscription');
    Route::get('subscription/confirm/{remember_token}', 'PostController@confirmMailSubscription');
    Route::get('get/counts', 'PostController@getCounts');
    Route::put('update/counts', 'PostController@updateCounts');
    Route::post('send/contact', 'PostController@sendMailContact');
});