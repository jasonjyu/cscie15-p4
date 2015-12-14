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
    <link href='/css/posts.css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Posts</h2>

    {{-- if $posts is not empty, then display the posts --}}
    @include('layouts.posts')
@stop

{{--
This `body` section will be yielded right before the closing </body> tag. Use it
to add specific things that *this* View needs at the end of the body, such as a
page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/posts.js'></script> --}}
@stop
