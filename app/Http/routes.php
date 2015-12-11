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
 * Registers routes that require authentication.
 */
Route::group(['middleware' => 'auth'], function() {
    /**
     * Registers Hashtags pages using implicit Controller routing.
     */
    Route::controller('/hashtags', 'HashtagController');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

/**
 * Registers the GET route to the login page.
 */
Route::get('/login', 'Auth\AuthController@getLogin');

/**
 * Registers the POST route to process the login page.
 */
Route::post('/login', 'Auth\AuthController@postLogin');

/**
 * Registers the GET route to the logout page.
 */
Route::get('/logout', 'Auth\AuthController@getLogout');

/**
 * Registers the GET route to the registration page.
 */
Route::get('/register', 'Auth\AuthController@getRegister');

/**
 * Registers the POST route to process the registration page.
 */
Route::post('/register', 'Auth\AuthController@postRegister');


/*
|--------------------------------------------------------------------------
| Debug/Test Local Routes
|--------------------------------------------------------------------------
*/
if (App::environment('local')) {
    /**
     * Registers the GET route to the login confirmation test page.
     */
    Route::get('/confirm-login', function() {
        // You may access the authenticated user via the Auth facade
        $user = Auth::user();
        if ($user) {
            echo 'You are logged in.';
            dump($user->toArray());
        } else {
            echo 'You are not logged in.';
        }
        return;
    });

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
        $search_results = Twitter::getSearch([
            'q'           => 'taylorswift',
            'lang'        => 'en',
            'result_type' => 'popular'
        ]);
        dump($search_results);
        echo '<h1>Tweets</h1>';
        foreach ($search_results->statuses as $tweet) {
            // $info = Oembed::cache(Twitter::linkTweet($tweet), []);
            // echo $info->code;
            echo '<iframe class="twitter-tweet" ';
            echo '        src="http://twitframe.com/show?url=',
                urlencode(Twitter::linkTweet($tweet)), '"';
            echo '        frameborder="0"';
            echo '        height="480">';
            echo '</iframe>';
            // echo Twitter::linkify($tweet),
            //     '<br/><a href=',
            //     Twitter::linkTweet($tweet), '>',
            //     Carbon\Carbon::createFromFormat('D M d H:i:s P Y',
            //         $tweet->created_at),
            //     '</a><br/><br/>';
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
            echo '<iframe class="instagram-media" ';
            echo '        src="', $media->link, 'embed/captioned/"';
            echo '        frameborder="0"';
            echo '        height="480">';
            echo '</iframe>';
            // echo $media->caption ? $media->caption->text : '',
            //     '<br/><a href=',
            //     $media->link, '>',
            //     Carbon\Carbon::createFromTimestamp($media->created_time),
            //     '</a><br/><br/>';
        }

        $popular_media = Instagram::getPopularMedia();
        dump($popular_media);
        echo '<h1>Popular Media</h1>';
        foreach ($popular_media->data as $media) {
            echo '<iframe class="instagram-media" ';
            echo '        src="', $media->link, 'embed/captioned/"';
            echo '        frameborder="0"';
            echo '        height="480">';
            echo '</iframe>';
            // echo $media->caption ? $media->caption->text : '',
            //     '<br/><a href=',
            //     $media->link, '>',
            //     Carbon\Carbon::createFromTimestamp($media->created_time),
            //     '</a><br/><br/>';
        }

        return 'vinkla/instagram';
    });

    /**
     * Registers the GET route to the oscarotero/embed package test page.
     */
    Route::get('/oembed/oscarotero', function () {
        echo '<script type="text/javascript">';
        echo '    function resizeIframe(obj) {';
        echo '        obj.style.height = obj.contentWindow.document.body.scrollHeight + "px";';
        echo '    }';
        echo '</script>';
        echo '<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>';
        echo '<a class="embedly-card" href="https://twitter.com/taylorswift13/status/673375405013790720">Taylor Swift on Twitter</a>';
        echo '<iframe class="instagram-media" src="https://www.instagram.com/p/9h8em8jvCQ/embed/captioned/" frameborder="0" width="500" height="720"></iframe>';
        echo '<iframe class="instagram-media" src="https://www.instagram.com/p/9h8POJjvB2/embed/captioned/" frameborder="0" width="500" height="720"></iframe>';
        echo '<iframe class="instagram-media instagram-media-rendered" id="instagram-embed-0" src="https://www.instagram.com/p/tsxp1hhQTG/embed/captioned/?v=6" allowtransparency="true" frameborder="0" height="848" data-instgrm-payload-id="instagram-media-payload-0" scrolling="no" style="background-color: rgb(255, 255, 255); border: 0px; margin: 1px; max-width: 658px; width: calc(100% - 2px); border-top-left-radius: 4px; border-top-right-radius: 4px; border-bottom-right-radius: 4px; border-bottom-left-radius: 4px; box-shadow: rgba(0, 0, 0, 0.498039) 0px 0px 1px 0px, rgba(0, 0, 0, 0.14902) 0px 1px 10px 0px; display: block; padding: 0px;"></iframe>';
        echo '<iframe class="twitter-tweet" src="http://twitframe.com/show?url=', urlencode('https://twitter.com/vogueaustralia/status/670555453898645504'), '" frameborder="0" width="500" height="720"></iframe>';
        echo '<iframe class="twitter-tweet" src="http://twitframe.com/show?url=', urlencode('https://twitter.com/PerezHilton/status/671731077539467265'), '" frameborder="0" width="500" height="720"></iframe>';
        echo '<iframe class="twitter-tweet" src="http://twitframe.com/show?url=', urlencode('https://twitter.com/ANZStadium/status/670454514302906368'), '" frameborder="0" width="500" height="720"></iframe>';
        // echo '<iframe class="tumblr-post" src="https://embed.tumblr.com/embed/post/zPM4x6zcKnJ2mnCWD5dCDQ/131627658976" frameborder="0" width="500" height="720"></iframe>';
        // echo '<iframe class="tumblr-post" src="https://embed.tumblr.com/embed/post/zPM4x6zcKnJ2mnCWD5dCDQ/134872428806" frameborder="0" width="500" height="860"></iframe>';
        // echo '<iframe class="tumblr-post" src="https://embed.tumblr.com/embed/post/zPM4x6zcKnJ2mnCWD5dCDQ/133871813361" frameborder="0" width="500" height="860"></iframe>';
        // echo '<iframe class="tumblr-post" src="https://embed.tumblr.com/embed/post/hxYiedm7s4mX7u4CMyi0aQ/134926222738" frameborder="0" width="500" height="720"></iframe>';
        echo '<iframe class="tumblr-post" src="https://embed.tumblr.com/embed/post/qU9WMukWE04hIZ9JMlCqDg/134948244742" frameborder="0" width="500" height="720"></iframe>';
        echo '<blockquote class="twitter-tweet"><p lang="en" dir="ltr"><a href="https://twitter.com/hashtag/TaylorSwift?src=hash">#TaylorSwift</a> singing <a href="https://twitter.com/hashtag/LoveStory?src=hash">#LoveStory</a> <a href="https://twitter.com/hashtag/voguegoldenticket?src=hash">#voguegoldenticket</a> <a href="https://twitter.com/hashtag/voguexsamsung?src=hash">#voguexsamsung</a> <a href="https://twitter.com/SamsungAU">@samsungau</a> <a href="https://t.co/sel85IZ1Ev">pic.twitter.com/sel85IZ1Ev</a></p>&mdash; Vogue Australia (@vogueaustralia) <a href="https://twitter.com/vogueaustralia/status/670555453898645504">November 28, 2015</a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
        echo '<blockquote class="twitter-tweet"><p lang="en" dir="ltr"><a href="https://twitter.com/hashtag/TaylorSwift?src=hash">#TaylorSwift</a> isn&#39;t the only celeb with awkward dance moves, and we&#39;ve got the proof!! <a href="https://t.co/dxyFmdRyw3">https://t.co/dxyFmdRyw3</a> <a href="https://t.co/bhx40OMiyp">pic.twitter.com/bhx40OMiyp</a></p>&mdash; Perez Hilton (@PerezHilton) <a href="https://twitter.com/PerezHilton/status/671731077539467265">December 1, 2015</a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
        echo '<blockquote class="twitter-tweet"><p lang="en" dir="ltr">SO many awesome outfits already on display <a href="https://twitter.com/ANZStadium">@ANZStadium</a>! Swifties are the best! <a href="https://twitter.com/hashtag/1989TourSydney?src=hash">#1989TourSydney</a> <a href="https://twitter.com/hashtag/TaylorSwift?src=hash">#TaylorSwift</a> <a href="https://t.co/Wnz9wsjFDw">pic.twitter.com/Wnz9wsjFDw</a></p>&mdash; ANZ Stadium (@ANZStadium) <a href="https://twitter.com/ANZStadium/status/670454514302906368">November 28, 2015</a></blockquote><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
        echo '<br>';

        return 'oembed/oscarotero';
    });

    /**
     * Registers the GET route to the jooorooo/oembed package test page.
     */
    Route::get('/oembed/jooorooo', function () {
        $info = Oembed::cache('https://twitter.com/vogueaustralia/statuses/670555453898645504', []);
        echo $info->code;
        $info = Oembed::cache('https://twitter.com/PerezHilton/statuses/671731077539467265', []);
        echo $info->code;
        $info = Oembed::cache('https://twitter.com/ANZStadium/statuses/670454514302906368', []);
        echo $info->code;
        $info = Oembed::cache('https://www.instagram.com/p/9h8POJjvB2/', []);
        echo $info->code;
        $info = Oembed::cache('https://www.instagram.com/p/9h8em8jvCQ/', []);
        echo $info->code;
        echo '<br>';

        return 'oembed/jooorooo';
    });
}
