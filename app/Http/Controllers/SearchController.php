<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Displays the search results page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        // parse request
        $hashtag = $request["search"];

        // search social media feeds if a hashtag is specified
        if (isset($hashtag)) {
            $twitter_results = $this->searchTwitter($hashtag);
            $instagram_results = $this->searchInstagram($hashtag);
        }

        // return the search results page
        return view("search.index")->with("twitter_results", $twitter_results)
            ->with("instagram_results", $instagram_results);
    }

    /**
     * Searches Twitter for the specified $hashtag.
     *
     * @example array($tweet1, $tweet2, $tweet3)
     * @param  string  $hashtag
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
     * @param  string  $hashtag
     * @return array|object
     */
    protected function searchInstagram($hashtag)
    {
        $search_results = \Instagram::getTagMedia($hashtag, 50);

        return $search_results->data;
    }
}
