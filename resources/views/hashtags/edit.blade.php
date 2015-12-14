@extends('layouts.master')

@section('title')
    HashTagGregator - Edit Hashtags
@stop

{{--
This `head` section will be yielded right before the closing </head> tag. Use it
to add specific things that *this* View needs in the head, such as a page
specific styesheets.
--}}
@section('head')
    <link href='/css/search.css' rel='stylesheet'/>
    <link href='/css/hashtags.css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Edit Hashtags</h2>

    {{-- if there are $hashtags, then print out the hashtag terms --}}
    @if (isset($hashtags) && count($hashtags) > 0)
        <p>
            <a href='/hashtags' data-transition='none'>View</a>
            |
            <a href='/hashtags/delete' data-transition='none'>Delete</a>
            |
            Edit
        </p>
        <form method='post' action='/hashtags/edit' data-transition='none'
              data-ajax='false'>
            {!! csrf_field() !!}
            <div class='ui-field-contain'>
                <legend>Edit hashtags to update:</legend>
                <div class='hashtags'>
                    @foreach ($hashtags as $hashtag)
                        <input type='text'
                               name='edited_hashtags[{{ $hashtag->id }}]'
                               value='{{ $_POST['edited_hashtags'][$hashtag->id] or $hashtag->term }}'
                               placeholder='{{ $hashtag->term }}'/>
                    @endforeach
                </div>
            </div>
            <button type='submit' class='btn btn-primary'>Update</button>
        </form>

        {{-- if there are errors, then print them out --}}
        @include('layouts.errors')
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
