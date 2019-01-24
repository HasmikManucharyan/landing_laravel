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

Route::group(['middleware'=>'web'], function () {
    Route::match(['get','post'],'/', ['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);
    Route::auth();
});

Route::group(['prefix'=>'admin','middleware'=>'auth'], function() {
	Route::get('/',function() {
        if(view()->exists('admin.index')) {
            $data = ['title' => 'Admin Panel'];
            return view('admin.index', $data);
        }
	});

	Route::group(['prefix'=>'pages'],function() {
		Route::get('/',['uses'=>'PagesController@execute','as'=>'pages']);
		Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute','as'=>'PagesAdd']);
		Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'PagesEdit']);
	});

	Route::group(['prefix'=>'portfolio'],function() {
		Route::get('/',['uses'=>'PortfolioController@execute','as'=>'portfolio']);
		Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute','as'=>'PortfolioAdd']);
		Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute','as'=>'PortfolioEdit']);
	});

	Route::group(['prefix'=>'services'],function() {
		Route::get('/',['uses'=>'ServiceController@execute','as'=>'services']);
		Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execute','as'=>'ServiceAdd']);
		Route::match(['get','post','delete'],'/edit/{service}',['uses'=>'ServiceEditController@execute','as'=>'ServiceEdit']);
	});
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
