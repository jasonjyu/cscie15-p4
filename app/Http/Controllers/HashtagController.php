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
        // get the user logged in
        $user = \Auth::user();

        // if a user is logged in, then display the user's saved hashtags
        // otherwise, do not display any hashtags
        if ($user) {
            // return the Hashtags page with the user's saved hashtags
            $view = view('hashtags.index')->with('hashtags', $user->hashtags);
        } else {
            // return the Hashtags page without any hashtags
            $view = view('hashtags.index');
        }

        return $view;
    }
}
