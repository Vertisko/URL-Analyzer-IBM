<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('', 'AnalyzerController@intro')->name('analyzer.get'); // DONE
Route::post('', 'AnalyzerController@analyze')->name('analyzer.post'); // DONE

//Route::group(['prefix' => 'api'], function () {
//    Route::group(['prefix' => 'analyzer'], function () {
//        Route::post('', 'AnalyzerController@analyzeJson')->name('analyzer.post'); // DONE
//    });
//    Route::group(['prefix' => 'curl'], function () {
//        Route::get('body', 'ClientUrlController@body')->name('curl.body'); // DONE
//        Route::get('header', 'ClientUrlController@header')->name('curl.header'); // DONE
//    });
//    Route::group(['prefix' => 'image'], function () {
//        Route::get('', 'ImageAltController@altsComputation')->name('imageAlt.altsComputation'); // DONE
//    });
//    Route::group(['prefix' => 'http'], function () {
//        Route::get('', 'HttpController@httpTest')->name('http.httpTest'); // DONE
//    });
//    Route::group(['prefix' => 'gzip'], function () {
//        Route::get('', 'GzipEncodingController@gzipTest')->name('gzip.gzipTest'); // DONE
//    });
//
//    Route::group(['prefix' => 'webp'], function () {
//        Route::get('', 'ImageWebPController@webPTest')->name('webP.webPTest'); // DONE
//    });
//
//    Route::group(['prefix' => 'insight'], function () {
//        Route::get('', 'PageSpeedInsightController@insightAnalysis')->name('insight.insightAnalysis'); // DONE
//    });
//});

