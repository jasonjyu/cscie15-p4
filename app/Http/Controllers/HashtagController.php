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
        $hashtags = $this->getUserHashtags();
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
        $hashtags = $this->getUserHashtags();
        $view = view('hashtags.delete')->with('hashtags', $hashtags);

        return $view;
    }

    /**
     * Processes the Delete Hashtags page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postDelete(Request $request)
    {
        // validate request
        $this->validate(
            $request, [
                'deleted_hashtags' => 'array',
            ]);

        // parse request
        $deleted_hashtags = $request['deleted_hashtags'];

        // delete selected hashtags
        \App\Hashtag::destroy($deleted_hashtags);

        // redirect to the Hashtags page
        \Session::flash('flash_message', 'Deleted selected hashtags.');
        $view = redirect('/hashtags');

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
        $hashtags = $this->getUserHashtags();
        $view = view('hashtags.edit')->with('hashtags', $hashtags);

        return $view;
    }

    /**
     * Processes the Edit Hashtags page.
     *
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        // validate request
        $this->validate(
            $request, [
                'edited_hashtags' => 'array',
            ]);

        // parse request
        $edited_hashtags = $request['edited_hashtags'];

        // update selected hashtags
        $succeeded = true;
        $hashtags = $this->getUserHashtags();
        foreach($edited_hashtags as $id => $term) {
            if (!empty(trim($term))) {
                // verify hashtag term does not already exists
                $hashtag = $hashtags->first(function ($key, $val) use ($term) {
                    return $val->term == $term;
                });
                if ($hashtag) {
                    \Session::flash('flash_message',
                        'Hashtag \''.$term.'\' already exists.');
                    $succeeded = false;
                    break;
                }

                $hashtag = $hashtags->find($id);
                if ($hashtag) {
                    $hashtag->term = $term;
                    $hashtag->save();
                }
            }
        }

        if ($succeeded) {
            // redirect to the Hashtags page if update succeeded
            \Session::flash('flash_message', 'Updated edited hashtags.');
            $view = redirect('/hashtags');
        } else {
            // otherwise, return the Edit Hashtags page
            $view = view('hashtags.edit')->with('hashtags', $hashtags);
        }

        return $view;
    }

    /**
     * Gets the current user's saved hashtags.
     *
     * @example array($hashtag1, $hashtag2, $hashtag3)
     * @return array|object
     */
    protected function getUserHashtags()
    {
        return \App\Hashtag::where('user_id', '=', \Auth::id())->orderBy('term',
            'ASC')->get();
    }
}
