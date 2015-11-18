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

/**
 * Registers the GET route to the application landing page.
 */
Route::get('/', 'SearchController@getIndex');

/**
 * Registers the GET route to the Search page.
 */
Route::get('/search', 'SearchController@getIndex');

/**
 * Registers the GET route to the Hashtags page.
 */
Route::get('/hashtags', 'HashtagController@getIndex');

/**
 * Registers the GET route to the codezero/twitter package test page.
 */
Route::get('/twitter/codezero', function () {
    $config = __DIR__ . '/../../config/twitter.php';
    $twitter = new CodeZero\Twitter\Twitter($config);
    $tweets = $twitter->searchTweets('taylorswift', 50);
    dump($tweets);

    return 'codezero/twitter';
});

/**
 * Registers the GET route to the thujohn/twitter package test page.
 */
Route::get('/twitter/thujohn', function () {
    $search_results = Twitter::getSearch(['q' => 'taylorswift', 'lang' => 'en',
        'result_type' => 'popular']);
    dump($search_results);
    echo '<h1>Tweets</h1>';
    foreach ($search_results->statuses as $tweet) {
        echo '<a href=', Twitter::linkTweet($tweet), '>', $tweet->text,
        '</a><br/>', Carbon\Carbon::createFromFormat('D M d H:i:s P Y',
        $tweet->created_at), '<br/><br/>';
    }

    return 'thujohn/twitter';
});

/**
 * Registers the GET route to the vinkla/instagram package test page.
 */
Route::get('/instagram/vinkla', function () {
    $tag_media = Instagram::getTagMedia('taylorswift', 50);
    dump($tag_media);
    echo '<h1>Tag Media</h1>';
    foreach ($tag_media->data as $media) {
        echo '<a href=', $media->link, '>', $media->caption ?
            $media->caption->text : $media->link, '</a><br/>',
            Carbon\Carbon::createFromTimestamp($media->created_time),
            '<br/><br/>';
    }

    $popular_media = Instagram::getPopularMedia();
    dump($popular_media);
    echo '<h1>Popular Media</h1>';
    foreach ($popular_media->data as $media) {
        echo '<a href=', $media->link, '>', $media->caption ?
            $media->caption->text : $media->link, '</a><br/>',
            Carbon\Carbon::createFromTimestamp($media->created_time),
            '<br/><br/>';
    }

    return 'vinkla/instagram';
});
