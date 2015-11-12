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
        // if request query parameters array is empty,
        // then return default search page
        if (empty($request->all())) {
            $view = view("search.index");
        } else {
            // validate request
            $this->validate(
                $request,
                [
                    "hashtag" => "required"
                ]);

            // parse request
            $hashtag = $request["hashtag"];

            // search social media feeds for the specified hashtag
            $twitter_results = $this->searchTwitter($hashtag);
            $instagram_results = $this->searchInstagram($hashtag);

            // return the search results page
            $view = view("search.index")
                ->with("twitter_results", $twitter_results)
                ->with("instagram_results", $instagram_results);
        }

        return $view;
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
