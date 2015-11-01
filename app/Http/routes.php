<?php

use CodeZero\Twitter\Twitter;

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

/**
 * Registers the GET route to the application landing page.
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * Registers the GET route to the codezero/twitter test page.
 */
Route::get('/twitter/codezero', function () {
    $config = __DIR__ . '/../../config/twitter.php';
    $twitter = new Twitter($config);
    $tweets = $twitter->searchTweets('taylorswift', 50);
    dd($tweets);

    return 'codezero/twitter';
});
