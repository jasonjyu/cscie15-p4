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
                $request,
                [
                    'term' => 'required'
                ]);

            // parse request
            $term = $request->term;

            // save off hashtag data
            $this->saveHashtag($term);

            // search social media feeds for the specified hashtag
            $twitter_results = $this->searchTwitter($term);
            $instagram_results = $this->searchInstagram($term);

            // return the search results page
            $view = view('search.index')
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
        $search_results = \Twitter::getSearch(['q' => $hashtag, 'lang' => 'en',
            'result_type' => 'popular']);

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
}
