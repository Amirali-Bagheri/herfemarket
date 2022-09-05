<?php

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
Route::prefix('v1/seo')->group(function () {
    Route::namespace('Api\v1')->group(function () {
        Route::any('siteinfo/{site}', 'SeoController@siteinfo');

        Route::get('alexa_top_global', 'SeoController@AlexaTopGlobalSites');
        Route::get('alexa_top_iran', 'SeoController@AlexaTopIranSites');
        Route::get('alexa-rank/{site}', 'SeoController@alexaRank');
        Route::get('site-speed/{site}', 'SeoController@siteSpeed');
        Route::get('msn_backlinks/{domain}', 'SeoController@msn_backlinks');
        Route::get('google_page_rank/{domain}', 'SeoController@googlePageRank');
    });
});
