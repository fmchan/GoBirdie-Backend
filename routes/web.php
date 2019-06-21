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

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
	Route::get('/', 'HomeController@index')->name('home');
	
	Route::resource('permissions', 'PermissionController');
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');

	Route::resource('tags', 'TagController');
	Route::resource('categoryArticles', 'Category_articleController');
	Route::resource('categoryPlaces', 'Category_placeController');
	Route::resource('facilities', 'FacilityController');
	Route::resource('organizations', 'OrganizationController');
	Route::resource('areas', 'AreaController');
	Route::resource('hours', 'HourController');

	Route::resource('cities', 'CityController');
	Route::resource('districts', 'DistrictController');

	Route::resource('articles', 'ArticleController');
	Route::resource('places', 'PlaceController');

	Route::post('/articles/{id}/delete', 'ArticleController@deleteImage')->name('articles.delete');
});

Route::get('/home', 'HomeController@index');