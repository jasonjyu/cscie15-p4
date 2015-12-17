@extends('layouts.master')

@section('title')
    HashTagGregator - Search
@stop

{{--
This `head` section will be yielded right before the closing </head> tag. Use it
to add specific things that *this* View needs in the head, such as a page
specific styesheets.
--}}
@section('head')
@stop

@section('content')
    <h2>Search</h2>

    {{-- the search form --}}
    @include('layouts.search')

    {{-- display the login reminder if user not logged in --}}
    @if (!isset($user))
        <br/>
        <p>
            <a href='/login' data-ajax='false'>Login</a> to save
            <a href='/posts' data-ajax='false'>posts</a> and manage searched
            <a href='/hashtags' data-ajax='false'>hashtags</a>.
        </p>
    @endif

    {{-- display the search term and posts if they exist --}}
    @if (isset($term))
        <h3>#{{ $term }}</h3>

        {{-- if there are posts, then display the posts --}}
        @if (isset($posts) && count($posts) > 0)
            @include('layouts.posts')
        {{-- otherwise, display a message indicating there are no posts --}}
        @else
            <p>Could not find any posts. Try searching for a different hashtag.</p>
        @endif
    @endif
@stop

{{--
This `body` section will be yielded right before the closing </body> tag. Use it
to add specific things that *this* View needs at the end of the body, such as a
page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/search.js'></script> --}}
@stop
