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
        // return the Posts page with the user's saved posts
        $posts = $this->getUserPosts();
        $view = view('posts.index')->with('posts', $posts);

        return $view;
    }

    /**
     * Displays the Create Posts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        // redirect to the previous page
        $view = back();

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

        // create a post if it does not exist
        $post = \App\Post::firstOrCreate($request->except('_token'));

        // get the user logged in
        $user = \Auth::user();

        // if a user is logged in and the post is not already associated,
        // then associate the user with the post
        $posts = $this->getUserPosts();
        if (isset($user) && !$posts->contains('id', $post->id)) {
            $user->posts()->save($post);
        }

        // indicate saving of the post
        \Session::flash('flash_message',
            'Saved post <a href=\''.$uri.'\' target=\'_blank\'>'.$uri.'</a>.');

        // redirect to the previous page
        // $view = redirect('/posts');
        $view = back();

        return $view;
    }

    /**
     * Displays the Delete Posts page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDelete()
    {
        // return the Delete Posts page with the user's saved posts and posts
        // form enabled
        $posts = $this->getUserPosts();
        $view = view('posts.delete')->with([
            'posts' => $posts,
            'posts_enable_form' => true,
        ]);

        return $view;
    }

    /**
     * Processes the Delete Post request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postDelete(Request $request)
    {
        // validate request
        $this->validate($request, [
            'post_id' => 'required|numeric|min:1',
        ]);

        // parse request
        $post_id = $request->post_id;

        // get the post
        $post = \App\Post::find($post_id);

        // if the post is found, remove its association with the current user
        if (isset($post)) {
            $post->users()->detach(\Auth::id());

            // if the post has no more user associations, then delete it
            if ($post->users->isEmpty()) {
                $post->delete();
            }

            // indicate unsaving of post
            \Session::flash('flash_message', 'Unsaved post <a href=\''.
                $post->uri.'\' target=\'_blank\'>'.$post->uri.'</a>.');
        } else {
            // indicate post is not found
            \Session::flash('flash_message', 'Could not find Post ID = '.
                $post_id.'.');
        }

        // redirect to the previous page
        // $view = redirect('/posts');
        $view = back();

        return $view;
    }

    /**
     * Gets the current user's saved posts.  Returns an empty Collection if user
     * is not logged in.
     *
     * @example Collection($post1, $post2, $post3)
     * @return Collection
     */
    protected function getUserPosts()
    {
        // if a user is logged in, then return the user's saved posts
        // otherwise, return an empty Collection
        return \Auth::check() ? \Auth::user()->posts : collect([]);
    }
}
