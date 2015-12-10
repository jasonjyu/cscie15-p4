<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Displays the Search results page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        // if request query parameters array is empty,
        // then return default search page
        if (empty($request->all())) {
            $view = view('search.index');
        } else {
            // validate request
            $this->validate(
                $request, [
                    'term' => 'required',
                ]);

            // parse request
            $term = strtolower(preg_replace('/\s+/', '',
                $request->term));  // remove whitespace, convert to lowercase

            // save off hashtag data
            $this->saveHashtag($term);

            // search social media provider feeds for the specified hashtag
            $twitter_results = $this->searchTwitter($term);
            $instagram_results = $this->searchInstagram($term);

            // convert results to \App\Post models
            $posts = [];

            // convert Twitter results to \App\Post models
            foreach ($twitter_results as $tweet) {
                $posts[] = $this->createPostTwitter($tweet);
            }

            // convert Instagram results to \App\Post models
            foreach ($instagram_results as $insta) {
                $posts[] = $this->createPostInstagram($insta);
            }

            // return the search results page
            $view = view('search.index')->with(compact([
                'term',
                'posts',
                // 'twitter_results',
                // 'instagram_results',
            ]));
        }

        return $view;
    }

    /**
     * Saves specified hashtag $term to database and associates the hashtag with
     * the user logged in if applicable.
     *
     * @param  string $term
     */
    protected function saveHashtag($term)
    {
        // if a user is logged, then associate the user with the hashtag
        if (\Auth::check()) {
            // get the user id logged in
            $user_id = \Auth::id();

            // create a hashtag associated with the user if it does not exist
            \App\Hashtag::firstOrCreate(compact('term', 'user_id'));
        }
    }

    /**
     * Searches Twitter for the specified $hashtag.
     *
     * @example array($tweet1, $tweet2, $tweet3)
     * @param  string $hashtag
     * @return array|object
     */
    protected function searchTwitter($hashtag)
    {
        $search_results = \Twitter::getSearch([
            'q'           => $hashtag,
            'lang'        => 'en',
            'result_type' => 'popular',
        ]);

        return $search_results->statuses;
    }

    /**
     * Searches Instagram for the specified $hashtag.
     *
     * @example array($post1, $post2, $post3)
     * @param  string $hashtag
     * @return array|object
     */
    protected function searchInstagram($hashtag)
    {
        $search_results = \Instagram::getTagMedia($hashtag, 50);

        return $search_results->data;
    }

    /**
     * Creates an \App\Post model object from specified Twitter $tweet object.
     *
     * @param  object $tweet
     * @return object
     */
    protected function createPostTwitter($tweet)
    {
        // // check if post was already created
        // $uri = \Twitter::linkTweet($tweet);
        // $post = \App\Post::where('uri', '=', $uri)->first();
        //
        // // create post if needed
        // if (!$post) {
        //     $post = new \App\Post();
        //     $post->provider = \App\Post::PROVIDER_TWITTER;
        //     $post->uri = $uri;
        //     $post->source_time = \Carbon\Carbon::createFromFormat(
        //         'D M d H:i:s P Y', $tweet->created_at)->toDateTimeString();
        //     $post->text = \Twitter::linkify($tweet);
        // }
        //
        // create post
        $post = new \App\Post();
        $post->provider = \App\Post::PROVIDER_TWITTER;
        $post->uri = \Twitter::linkTweet($tweet);
        $post->source_time = \Carbon\Carbon::createFromFormat(
            'D M d H:i:s P Y', $tweet->created_at)->toDateTimeString();
        $post->text = \Twitter::linkify($tweet);

        // cache oEmbed request
        \Oembed::cache($post->uri, []);

        // add media if available
        if (isset($tweet->entities->media)) {
            foreach ($tweet->entities->media as $tweet_medium) {
                // $medium = new \App\Medium();
                // $medium->type = $tweet_medium->type;
                // $medium->uri = $tweet_medium->media_url_https;
                // $post->media()->save($medium);
                $post->media_uri = $tweet_medium->media_url_https;
            }
        }

        return $post;
    }

    /**
     * Creates an \App\Post model object from specified Instagram $insta object.
     *
     * @param  object $insta
     * @return object
     */
    protected function createPostInstagram($insta)
    {
        // // check if post was already created
        // $uri = $insta->link;
        // $post = \App\Post::where('uri', '=', $uri)->first();
        //
        // // create post if needed
        // if (!$post) {
        //     $post = new \App\Post();
        //     $post->provider = \App\Post::PROVIDER_INSTAGRAM;
        //     $post->uri = $uri;
        //     $post->source_time = \Carbon\Carbon::createFromTimestamp(
        //         $insta->created_time)->toDateTimeString();
        //     $post->text = $insta->caption ? $insta->caption->text : '';
        // }
        //
        // create post
        $post = new \App\Post();
        $post->provider = \App\Post::PROVIDER_INSTAGRAM;
        $post->uri = $insta->link;
        $post->source_time = \Carbon\Carbon::createFromTimestamp(
            $insta->created_time)->toDateTimeString();
        $post->text = $insta->caption ? $insta->caption->text : '';

        // add media if available
        // $medium = new \App\Medium();
        // $medium->type = $insta->type;
        // $medium->uri = $insta->images->standard_resolution->url;
        // $post->media()->save($medium);
        $post->media_uri = $insta->images->standard_resolution->url;

        return $post;
    }
}
