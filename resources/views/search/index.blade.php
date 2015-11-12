@extends('layouts.master')

@section('title')
    Search Results
@stop

{{--
This `head` section will be yielded right before the closing </head> tag. Use it
to add specific things that *this* View needs in the head, such as a page
specific styesheets.
--}}
@section('head')
    <link href='/css/search.css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Search Results</h2>

    {{-- if there are errors, then print them out --}}
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- if the $twitter_results array is set, then print out the tweets --}}
    @if (isset($twitter_results))
        <div class='twitter-results'>
            <h3>Twitter</h3>
            @foreach ($twitter_results as $tweet)
                <a href={{ Twitter::linkTweet($tweet) }}>
                    {{ $tweet->text }}
                </a>
                <br>
                <br>
            @endforeach
        </div>
    @endif

    {{-- if the $twitter_results array is set, then print out the tweets --}}
    @if (isset($instagram_results))
        <div class='instagram-results'>
            <h3>Instagram</h3>
            @foreach ($instagram_results as $post)
                <a href={{ $post->link }}>
                    {{ $post->caption->text }}
                </a>
                <br>
                <br>
            @endforeach
        </div>
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
