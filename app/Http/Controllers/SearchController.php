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
            // $posts = collect($posts)->sortByDesc('source_time');

            // merge posts with current user's saved posts
            $this->mergePosts($posts);

            // enable form for posts if a user is logged in
            $posts_enable_form = \Auth::check();

            // return the search results page
            $view = view('search.index')->with(compact([
                'term',
                'posts',
                'posts_enable_form',
            ]));
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
        // create post
        $post = new Post();
        $post->provider = Post::PROVIDER_INSTAGRAM;
        $post->uri = $insta->link;
        $post->source_time = \Carbon\Carbon::createFromTimestamp(
            $insta->created_time)->toDateTimeString();
        $post->text = $insta->caption ? $insta->caption->text : '';

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
        // create post
        $post = new Post();
        $post->provider = Post::PROVIDER_TWITTER;
        $post->uri = \Twitter::linkTweet($tweet);
        $post->source_time = \Carbon\Carbon::createFromFormat(
            'D M d H:i:s P Y', $tweet->created_at)->toDateTimeString();
        $post->text = \Twitter::linkify($tweet);

        return $post;
    }

    /**
     * Merge posts with current user's saved posts by adding the post ID
     * attribute for matching post URI attributes.
     *
     * @param  array|object $posts posts array to merge
     */
    protected function mergePosts(array &$posts)
    {
        // get the user logged in
        $user = \Auth::user();

        // if a user is logged in, then continue to merge the posts
        if (isset($user)) {
            // get the user's saved posts
            $saved_posts = $user->posts;

            // merge each post with the current user's saved posts
            foreach ($posts as $post) {
                // find the saved post with a matching URI
                $uri = $post->uri;
                $saved_post = $saved_posts->first(
                    function ($key, $value) use ($uri) {
                        return $value->uri == $uri;
                    });

                // if the saved post is found, then merge its post ID
                if (isset($saved_post)) {
                    $post->id = $saved_post->id;
                }
            }
        }
    }
}
