<?php

//News
Route::get('news', 'CeddyG\ClaraNews\Http\Controllers\NewsController@index')
    ->middleware(config('clara.news.route.web.middleware'));

Route::get('news/{slug}', 'CeddyG\ClaraNews\Http\Controllers\NewsController@show')
    ->middleware(config('clara.news.route.web.middleware'));

Route::post('news-comment/{slug}', 'CeddyG\ClaraNews\Http\Controllers\NewsCommentController@store')
    ->middleware(config('clara.news.route.web.middleware'));

Route::group(['prefix' => config('clara.news.route.web-admin.prefix'), 'middleware' => config('clara.news.route.web-admin.middleware')], function()
{
    Route::resource('news', 'CeddyG\ClaraNews\Http\Controllers\Admin\NewsController', ['names' => 'admin.news']);
});

Route::group(['prefix' => config('clara.news.route.api.prefix'), 'middleware' => config('clara.news.route.api.middleware')], function()
{
    Route::get('news/index/ajax', 'CeddyG\ClaraNews\Http\Controllers\Admin\NewsController@indexAjax')->name('admin.news.index.ajax');
	Route::get('news/select/ajax', 'CeddyG\ClaraNews\Http\Controllers\Admin\NewsController@selectAjax')->name('admin.news.select.ajax');
});

//Category
Route::get('news-category/{slug}', 'CeddyG\ClaraNews\Http\Controllers\NewsCategoryController@show')
    ->middleware(config('clara.news.route.web.middleware'));
 
Route::group(['prefix' => config('clara.news-category.route.web.prefix'), 'middleware' => config('clara.news-category.route.web.middleware')], function()
{
    Route::resource('news-category', 'CeddyG\ClaraNews\Http\Controllers\Admin\NewsCategoryController', ['names' => 'admin.news-category']);
});

Route::group(['prefix' => config('clara.news-category.route.api.prefix'), 'middleware' => config('clara.news-category.route.api.middleware')], function()
{
    Route::get('news-category/index/ajax', 'CeddyG\ClaraNews\Http\Controllers\Admin\NewsCategoryController@indexAjax')->name('admin.news-category.index.ajax');
	Route::get('news-category/select/ajax', 'CeddyG\ClaraNews\Http\Controllers\Admin\NewsCategoryController@selectAjax')->name('admin.news-category.select.ajax');
});

//Tag
Route::group(['prefix' => config('clara.tag.route.web.prefix'), 'middleware' => config('clara.tag.route.web.middleware')], function()
{
    Route::resource('tag', 'CeddyG\ClaraNews\Http\Controllers\Admin\TagController', ['names' => 'admin.tag']);
});

Route::group(['prefix' => config('clara.tag.route.api.prefix'), 'middleware' => config('clara.tag.route.api.middleware')], function()
{
    Route::get('tag/index/ajax', 'CeddyG\ClaraNews\Http\Controllers\Admin\TagController@indexAjax')->name('admin.tag.index.ajax');
	Route::get('tag/select/ajax', 'CeddyG\ClaraNews\Http\Controllers\Admin\TagController@selectAjax')->name('admin.tag.select.ajax');
});