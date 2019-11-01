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

Route::post('/articles/{id}/heart', 'ArticleAPIController@operateHeart')->name('articles.heart');
Route::post('/places/{id}/heart', 'PlaceAPIController@operateHeart')->name('places.heart');

Route::resource('banners', 'BannerAPIController');

Route::resource('highlight_places', 'HighlightPlaceAPIController');

Route::resource('highlight_articles', 'HighlightArticleAPIController');

Route::resource('recommend_places', 'RecommendPlaceAPIController');

Route::resource('hot_keyword_places', 'HotKeywordPlaceAPIController');

Route::resource('hot_keyword_articles', 'HotKeywordArticleAPIController');

Route::resource('pages', 'PageAPIController');

Route::get('/home', 'HomeAPIController@index')->name('api.home');