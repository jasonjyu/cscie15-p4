<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HashtagController extends Controller
{
    /**
     * Displays the searched Hashtags page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        // query the database for saved hashtags
        $hashtags = \App\Hashtag::all();

        // return the search Hashtags page
        $view = view("hashtags.index")->with("hashtags", $hashtags);

        return $view;
    }
}
