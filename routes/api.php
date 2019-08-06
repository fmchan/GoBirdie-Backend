<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('tags', 'TagAPIController');

Route::resource('category_articles', 'Category_articleAPIController');

Route::resource('category_places', 'Category_placeAPIController');

Route::resource('facilities', 'FacilityAPIController');

Route::resource('organizations', 'OrganizationAPIController');

Route::resource('cities', 'CityAPIController');

Route::resource('districts', 'DistrictAPIController');

Route::resource('articles', 'ArticleAPIController');

Route::resource('places', 'PlaceAPIController');

Route::resource('areas', 'AreaAPIController');

Route::resource('hours', 'HourAPIController');

Route::post('/articles/{id}/heart', 'ArticleAPIController@addHeart')->name('articles.heart');
Route::post('/places/{id}/heart', 'PlaceAPIController@addHeart')->name('places.heart');