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
        // query the database for all posts
        $posts = \App\Post::all();

        // return the Posts page
        $view = view('posts.index')->with('posts', $posts);

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
        dump($request);

        return "GET /create";
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
        ]);

        // parse request
        dump($request);

        // redirect to the previous page
        $view = back();

        // return $view;
    }
}
