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
        // return the Hashtags page with the user's saved hashtags
        $hashtags = \App\Hashtag::where('user_id', '=', \Auth::id())->orderBy(
            'term','ASC')->get();
        $view = view('hashtags.index')->with('hashtags', $hashtags);

        return $view;
    }

    /**
     * Displays the Delete Hashtags page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDelete(Request $request)
    {
        // return the Delete Hashtags page with the user's saved hashtags
        $hashtags = \App\Hashtag::where('user_id', '=', \Auth::id())->orderBy(
            'term','ASC')->get();
        $view = view('hashtags.delete')->with('hashtags', $hashtags);

        return $view;
    }

    /**
     * Displays the Edit Hashtags page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit(Request $request)
    {
        // return the Edit Hashtags page with the user's saved hashtags
        $hashtags = \App\Hashtag::where('user_id', '=', \Auth::id())->orderBy(
            'term','ASC')->get();
        $view = view('hashtags.edit')->with('hashtags', $hashtags);

        return $view;
    }
}
