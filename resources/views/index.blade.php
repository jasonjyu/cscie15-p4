@extends('layouts.master')

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')
    <link href='/css/posts.css' rel='stylesheet'/>
    <link href='/css/search.css' rel='stylesheet'/>
    <link href='/css/home.css' type='text/css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Welcome</h2>

    {{-- the search form --}}
    @include('layouts.search')

    <br/>

    <blockquote>
        Start by searching for a hashtag. HashTagGregator searches various
        social media feeds for a specified hashtag and displays the matching
        posts. Registered users are able to save posts and manage their searched
        hashtags.
    </blockquote>
@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/home.js'></script> --}}
@stop
