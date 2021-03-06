@extends('layouts.master')

@section('title')
    HashTagGregator - Searched Hashtags
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

    {{-- if there are hashtags, then display the hashtag terms --}}
    @if (isset($hashtags) && count($hashtags) > 0)
        <p>
            View
            |
            <a href='/hashtags/delete'>Delete</a>
            |
            <a href='/hashtags/edit'>Edit</a>
        </p>
        <div class='hashtags'>
            <legend>Click a hashtag to search:</legend>
            <ul>
                @foreach ($hashtags as $hashtag)
                    <li>
                        <a href='/search?term={{ $hashtag->term }}'>
                            #{{ $hashtag->term }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    {{-- otherwise, display the search form --}}
    @else
        <p>You have not searched any hashtags.</p>
        @include('layouts.search')
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
