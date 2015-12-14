<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
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
    public function getIndex()
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
    public function getDelete()
    {
        // return the Delete Hashtags page with the user's saved hashtags
        $hashtags = $this->getUserHashtags();
        $view = view('hashtags.delete')->with('hashtags', $hashtags);

        return $view;
    }

    /**
     * Processes the Delete Hashtags request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postDelete(Request $request)
    {
        // validate request
        $this->validate($request, [
            'deleted_hashtags' => 'array',
        ]);

        // parse request
        $deleted_hashtags = $request['deleted_hashtags'];

        // delete selected hashtags if they exist
        if (!empty($deleted_hashtags)) {
            \App\Hashtag::destroy($deleted_hashtags);
            \Session::flash('flash_message', 'Deleted selected hashtags.');
        }

        // redirect to the Hashtags page
        $view = redirect('/hashtags');

        return $view;
    }

    /**
     * Displays the Edit Hashtags page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit()
    {
        // return the Edit Hashtags page with the user's saved hashtags
        $hashtags = $this->getUserHashtags();
        $view = view('hashtags.edit')->with('hashtags', $hashtags);

        return $view;
    }

    /**
     * Processes the Edit Hashtags request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request)
    {
        // validate request
        $this->validate($request, [
            'edited_hashtags' => 'array',
        ]);

        // parse request
        $edited_hashtags = $request['edited_hashtags'];

        // update selected hashtags
        $hashtags = $this->getUserHashtags();
        $num_updates = $this->updateUserHashtags($hashtags, $edited_hashtags);

        // flash messsage if 1 or more hashtags were updated
        if ($num_updates > 0) {
            \Session::flash('flash_message', 'Updated edited hashtags.');
        }

        // redirect to the Hashtags page if update succeeds, otherwise return
        // the Edit Hashtags page
        $view = $num_updates >= 0 ? redirect('/hashtags') :
            view('hashtags.edit')->with('hashtags', $hashtags);

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

    /**
     * Updates the current user's hashtags with the specified hashtag $terms and
     * returns the number of hashtags updated or -1 on failure.
     *
     * @param  Collection   $hashtags hashtag collection to update
     * @param  array|string $terms hashtag terms to update with
     * @return integer
     */
    protected function updateUserHashtags(Collection $hashtags, array $terms)
    {
        $num_updates = 0;
        foreach($terms as $id => $term) {
            // remove whitespace, convert to lowercase
            $term = strtolower(preg_replace('/\s+/', '', $term));

            if (!empty(trim($term))) {
                // verify hashtag term does not already exists
                $hashtag = $hashtags->first(
                    function ($key, $value) use ($id, $term) {
                        return $value->id != $id && $value->term == $term;
                    });
                if (isset($hashtag)) {
                    \Session::flash('flash_message',
                        'Hashtag \''.$term.'\' already exists.');
                    $num_updates = -1;
                    break;
                }

                // update hashtag term if not the same
                $hashtag = $hashtags->find($id);
                if (isset($hashtag) && $hashtag->term != $term) {
                    $hashtag->term = $term;
                    $hashtag->save();
                    $num_updates++;
                }
            }
        }

        return $num_updates;
    }
}
