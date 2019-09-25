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
	Route::post('/places/{id}/delete', 'PlaceController@deleteImage')->name('places.delete');

	Route::get('imports', 'ImportController@imports')->name('imports.index');
	Route::post('upload-images', 'ImportController@uploadImages')->name('imports.uploadImages');
	Route::post('delete-image', 'ImportController@deleteImage')->name('imports.deleteImage');
	Route::post('imports', 'ImportController@importExcel');
});

Route::get('/home', 'HomeController@index');

Route::resource('banners', 'BannerController');

Route::resource('highlightPlaces', 'HighlightPlaceController');

Route::resource('highlightArticles', 'HighlightArticleController');

Route::resource('recommendPlaces', 'RecommendPlaceController');

Route::resource('hotKeywordPlaces', 'HotKeywordPlaceController');

Route::resource('hotKeywordArticles', 'HotKeywordArticleController');

Route::resource('pages', 'PageController');