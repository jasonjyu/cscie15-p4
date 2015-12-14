<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Displays the Search results page.
     *
     * @param  \Illuminate\Http\Request $request
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
            $this->validate($request, [
                'term' => 'required',
            ]);

            // parse request
            $term = strtolower(preg_replace('/\s+/', '',
                $request->term));  // remove whitespace, convert to lowercase

            // save off hashtag term
            $this->saveHashtag($term);

            // search social media provider feeds for the specified hashtag term
            $posts = $this->searchHashtag($term);

            // sort posts
            Post::sortPosts($posts, 'sortByNewest');

            // return the search results page
            $view = view('search.index')->with(compact(['term', 'posts']));
        }

        return $view;
    }

    /**
     * Saves specified hashtag $term to database and associates the hashtag with
     * the user logged in if applicable.
     *
     * @param  string $term hashtag term to save off
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
     * Searches social media provider feeds for the specified $hashtag.
     *
     * @example array($post1, $post2, $post3)
     * @param  string $hashtag hashtag term to search for
     * @return array|object
     */
    protected function searchHashtag($term)
    {
        // search for $hashtag and convert results to \App\Post models
        $posts = [];
        $instagram_results = $this->searchInstagram($term);
        $twitter_results = $this->searchTwitter($term);

        // convert Instagram results to \App\Post models
        foreach ($instagram_results as $insta) {
            $posts[] = $this->createPostInstagram($insta);
        }

        // convert Twitter results to \App\Post models
        foreach ($twitter_results as $tweet) {
            $posts[] = $this->createPostTwitter($tweet);
        }

        return $posts;
    }

    /**
     * Searches Instagram for the specified hashtag $term.
     *
     * @example array($insta1, $insta2, $insta3)
     * @param  string $term hashtag term to search for
     * @return array|object
     */
    protected function searchInstagram($term)
    {
        $search_results = \Instagram::getTagMedia($term, 50);

        return $search_results->data;
    }

    /**
     * Searches Twitter for the specified $hashtag.
     *
     * @example array($tweet1, $tweet2, $tweet3)
     * @param  string $term hashtag term to search for
     * @return array|object
     */
    protected function searchTwitter($term)
    {
        $search_results = \Twitter::getSearch([
            'q'           => $term,
            'lang'        => 'en',
            'result_type' => 'popular',
        ]);

        return $search_results->statuses;
    }

    /**
     * Creates an \App\Post model object from specified Instagram $insta object.
     *
     * @param  object $insta Instagram post to convert to a Post model
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
        $post = new Post();
        $post->provider = Post::PROVIDER_INSTAGRAM;
        $post->uri = $insta->link;
        // $post->source_time = \Carbon\Carbon::createFromTimestamp(
        //     $insta->created_time)->toDateTimeString();
        $post->source_time = intval($insta->created_time);
        $post->text = $insta->caption ? $insta->caption->text : '';
        //
        // // add media if available
        // $post->media_uri = $insta->images->standard_resolution->url;

        return $post;
    }

    /**
     * Creates an \App\Post model object from specified Twitter $tweet object.
     *
     * @param  object $tweet Twitter tweet to convert to to a Post model
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
        $post = new Post();
        $post->provider = Post::PROVIDER_TWITTER;
        $post->uri = \Twitter::linkTweet($tweet);
        // $post->source_time = \Carbon\Carbon::createFromFormat(
        //     'D M d H:i:s P Y', $tweet->created_at)->toDateTimeString();
        $post->source_time = \Carbon\Carbon::createFromFormat(
            'D M d H:i:s P Y', $tweet->created_at)->timestamp;
        $post->text = \Twitter::linkify($tweet);
        //
        // // add media if available
        // if (isset($tweet->entities->media)) {
        //     foreach ($tweet->entities->media as $tweet_medium) {
        //         $post->media_uri = $tweet_medium->media_url_https;
        //     }
        // }

        return $post;
    }
}
