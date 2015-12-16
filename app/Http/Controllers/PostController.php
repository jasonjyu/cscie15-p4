<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    /**
     * Displays the Posts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        // get the user logged in
        $user = \Auth::user();

        // if a user is logged in, then display the user's saved posts
        // otherwise, do not display any posts
        if ($user) {
            // return the Posts page with the user's saved posts
            $view = view('posts.index')->with('posts', $user->posts);
        } else {
            // return the Posts page without any posts
            $view = view('posts.index');
        }

        return $view;
    }

    /**
     * Displays the Create Posts page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getCreate(Request $request)
    {
        // redirect to the Posts page
        $view = redirect('/posts');

        return $view;
    }

    /**
     * Processes the Create Post request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        // validate request
        $this->validate($request, [
            'provider'    => 'required',
            'uri'         => 'required|url',
            'source_time' => 'required',
        ]);

        // parse request
        $uri = $request->uri;

        // create post if it does not exist
        $post = \App\Post::firstOrCreate($request->except('_token'));

        // get the user logged in
        $user = \Auth::user();

        // if a user is logged in and the post is not already associated,
        // then associate the user with the post
        if ($user && !$user->posts->contains('id', $post->id)) {
            $user->posts()->save($post);
        }

        // indicate saving of post
        \Session::flash('flash_message',
            'Saved post <a href=\''.$uri.'\' target=\'_blank\'>'.$uri.'</a>.');

        // redirect to the previous page
        // $view = redirect('/posts');
        $view = back();

        return $view;
    }
}
