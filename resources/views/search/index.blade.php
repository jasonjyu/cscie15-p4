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
            <a href='/login' data-ajax='false'>Login</a> to save searched
            <a href='/hashtags' data-ajax='false'>hashtags</a> and
            <a href='/posts' data-ajax='false'>posts</a>.
        </p>
    @endif

    {{-- display the search term if it exists --}}
    @if (isset($term))
        <h3>#{{ $term }}</h3>
    @endif

    {{-- if $posts is not empty, then display the posts --}}
    @include('layouts.posts')
@stop

{{--
This `body` section will be yielded right before the closing </body> tag. Use it
to add specific things that *this* View needs at the end of the body, such as a
page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/search.js'></script> --}}
@stop
