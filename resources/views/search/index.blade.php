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
    <link href='/css/search.css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Search</h2>

    <form method='get' action='/search' data-transition='none'
        {{-- allow error and debug pages to open with jQuery libraries --}}
          {!! App::environment('local') ? 'data-ajax=\'false\'' : '' !!}>
        <input id='term'
               type='search'
               name='term'
               value='{{ $_GET['term'] or '' }}'
               placeholder='Search for a hashtag...'
               autofocus>
    </form>

    {{-- if there are errors, then print them out --}}
    @include('layouts.errors')

    {{-- if $posts is not empty, then display the posts --}}
    @include('layouts.posts')

    {{-- if $twitter_results is not empty, then display the tweets --}}
    @if (!empty($twitter_results))
        <div class='twitter-results'>
            <h3>Twitter</h3>
            @foreach ($twitter_results as $tweet)
                <div class='post'>
                    {!! Twitter::linkify($tweet) !!}
                    <br/>
                    <a href='{{ Twitter::linkTweet($tweet) }}' target='_blank'>
                        {{ Carbon\Carbon::createFromFormat('D M d H:i:s P Y',
                           $tweet->created_at) }}
                    </a>
                </div>
            @endforeach
        </div>
    @endif

    {{-- if $instagram_results is not empty, then display the media --}}
    @if (!empty($instagram_results))
        <div class='instagram-results'>
            <h3>Instagram</h3>
            @foreach ($instagram_results as $media)
                <div class='post'>
                    @if (isset($media->caption))
                        {{ $media->caption->text }}
                    @else
                        {{ $media->link }}
                    @endif
                    <br/>
                    <a href='{{ $media->link }}' target='_blank'>
                        {{ Carbon\Carbon::createFromTimestamp($media->created_time) }}
                    </a>
                </div>
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
