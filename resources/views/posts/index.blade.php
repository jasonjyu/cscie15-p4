@extends('layouts.master')

@section('title')
    HashTagGregator - Posts
@stop

{{--
This `head` section will be yielded right before the closing </head> tag. Use it
to add specific things that *this* View needs in the head, such as a page
specific styesheets.
--}}
@section('head')
@stop

@section('content')
    <h2>Posts</h2>

    {{-- if there are posts, then display the posts --}}
    @if (isset($posts) && count($posts) > 0)
        @include('layouts.posts')
    {{-- otherwise, display the search form --}}
    @else
        <p>You have not saved any posts. Start by searching for a hashtag.</p>
        @include('layouts.search')
    @endif
@stop

{{--
This `body` section will be yielded right before the closing </body> tag. Use it
to add specific things that *this* View needs at the end of the body, such as a
page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/posts.js'></script> --}}
@stop
