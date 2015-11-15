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
        <input id='search'
               type='search'
               name='hashtag'
               value='{{ $_GET['hashtag'] or '' }}'
               placeholder='Search for a hashtag...'
               autofocus>
    </form>

    {{-- if there are errors, then print them out --}}
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{-- if $twitter_results is not empty, then print out the tweets --}}
    @if (!empty($twitter_results))
        <div class='twitter-results'>
            <h3>Twitter</h3>
            @foreach ($twitter_results as $tweet)
                <a href='{{ Twitter::linkTweet($tweet) }}' target='_blank'>
                    {{ $tweet->text }}
                </a>
                <br/>
                <br/>
            @endforeach
        </div>
    @endif

    {{-- if $instagram_results is not empty, then print out the posts --}}
    @if (!empty($instagram_results))
        <div class='instagram-results'>
            <h3>Instagram</h3>
            @foreach ($instagram_results as $post)
                <a href='{{ $post->link }}' target='_blank'>
                    @if (isset($post->caption))
                        {{ $post->caption->text }}
                    @else
                        {{ $post->link }}
                    @endif
                </a>
                <br/>
                <br/>
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
