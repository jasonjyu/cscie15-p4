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
            $term = $request->term;

            // save off hashtag data
            $this->saveHashtag($term);

            // search social media feeds for the specified hashtag
            $twitter_results = $this->searchTwitter($term);
            $instagram_results = $this->searchInstagram($term);

            // convert results to \App\Post models
            $posts = array();

            // convert Twitter results to \App\Post models
            foreach ($twitter_results as $tweet) {
                $posts[] = $this->createPostTwitter($tweet);
            }

            // convert Instagram results to \App\Post models
            foreach ($instagram_results as $media) {
                $posts[] = $this->createPostInstagram($media);
            }

            // return the search results page
            $view = view('search.index')->with('posts', $posts)
                ->with('twitter_results', $twitter_results)
                ->with('instagram_results', $instagram_results);
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
        // get hashtag corresponding to the specified $term or create if it
        // does not exist
        $hashtag = \App\Hashtag::firstOrCreate(['term' => $term]);

        // get the user logged in
        $user = \Auth::user();

        // if a user is logged in and the hashtag is not already associated,
        // then associate the user with the hashtag
        if ($user && !$user->hashtags->contains($hashtag->id)) {
            $user->hashtags()->save($hashtag);
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
            'q' => $hashtag,
            'lang' => 'en',
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
        // $feed = \App\Post::FEED_TWITTER;
        // $source_id = $tweet->id_str;
        // $post = \App\Post::where(function($query) use($feed, $source_id) {
        //     $query->where('feed', '=', $feed)
        //           ->where('source_id', '=', $source_id);
        // })->first();
        //
        // // create post if needed
        // if (!$post) {
        //     $post = new \App\Post();
        //     $post->feed = $feed;
        //     $post->source_id = $source_id;
        //     $post->source_time = \Carbon\Carbon::createFromFormat(
        //         'D M d H:i:s P Y', $tweet->created_at);
        //     $post->uri = \Twitter::linkTweet($tweet);
        //     $post->text = \Twitter::linkify($tweet);
        // }
        $post = new \App\Post();
        $post->feed = \App\Post::FEED_TWITTER;
        $post->source_id = $tweet->id_str;
        $post->source_time = \Carbon\Carbon::createFromFormat(
            'D M d H:i:s P Y', $tweet->created_at)->toDateTimeString();
        $post->uri = \Twitter::linkTweet($tweet);
        $post->text = \Twitter::linkify($tweet);

        return $post;
    }

    /**
     * Creates an \App\Post model object from specified Instagram $media object.
     *
     * @param  object $media
     * @return object
     */
    protected function createPostInstagram($media)
    {
        // // check if post was already created
        // $feed = \App\Post::FEED_INSTAGRAM;
        // $source_id = $media->id;
        // $post = \App\Post::where(function($query) use($feed, $source_id) {
        //     $query->where('feed', '=', $feed)
        //           ->where('source_id', '=', $source_id);
        // })->first();
        //
        // // create post if needed
        // if (!$post) {
        //     $post = new \App\Post();
        //     $post->feed = $feed;
        //     $post->source_id = $source_id;
        //     $post->source_time = \Carbon\Carbon::createFromTimestamp(
        //         $media->created_time);
        //     $post->uri = $media->link;
        //     $post->text = $media->caption ? $media->caption->text : '';
        // }
        $post = new \App\Post();
        $post->feed = \App\Post::FEED_INSTAGRAM;
        $post->source_id = $media->id;
        $post->source_time = \Carbon\Carbon::createFromTimestamp(
            $media->created_time)->toDateTimeString();
        $post->uri = $media->link;
        $post->text = $media->caption ? $media->caption->text : '';

        return $post;
    }
}
