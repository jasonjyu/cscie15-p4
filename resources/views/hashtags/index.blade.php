@extends('layouts.master')

@section('title')
    TagGregator - Searched Hashtags
@stop

{{--
This `head` section will be yielded right before the closing </head> tag. Use it
to add specific things that *this* View needs in the head, such as a page
specific styesheets.
--}}
@section('head')
    <link href='/css/hashtags.css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Searched Hashtags</h2>

    {{-- if there are $hashtags, then print out the hashtag terms --}}
    @if (count($hashtags) > 0)
        <div class='hashtags'>
            @foreach ($hashtags as $hashtag)
                <a href='/search?term={{ $hashtag->term }}' data-ajax='false'>
                    #{{ $hashtag->term }}
                </a>
                <br/>
            @endforeach
        </div>
    @else
        <p>
            You have not searched any hashtags.
            Click <a href='/search' data-ajax='false'>here</a> to search.
        </p>
    @endif
@stop

{{--
This `body` section will be yielded right before the closing </body> tag. Use it
to add specific things that *this* View needs at the end of the body, such as a
page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/hashtags.js'></script> --}}
@stop
