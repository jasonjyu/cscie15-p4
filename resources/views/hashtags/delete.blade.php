@extends('layouts.master')

@section('title')
    HashTagGregator - Delete Hashtags
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
    <h2>Delete Hashtags</h2>

    {{-- if there are hashtags, then display the hashtag terms --}}
    @if (isset($hashtags) && count($hashtags) > 0)
        <p>
            <a href='/hashtags'>View</a>
            |
            Delete
            |
            <a href='/hashtags/edit'>Edit</a>
        </p>
        <div class='hashtags'>
            <legend>Select hashtags to delete:</legend>
            <form method='post' action='/hashtags/delete'>
                {!! csrf_field() !!}
                <fieldset data-role='controlgroup'>
                    @foreach ($hashtags as $hashtag)
                        <input id='{{ $hashtag->id }}'
                               type='checkbox'
                               name='deleted_hashtags[]'
                               value='{{ $hashtag->id }}'/>
                        <label for='{{ $hashtag->id }}'>
                            #{{ $hashtag->term }}
                        </label>
                    @endforeach
                </fieldset>
                <button type='submit' class='btn btn-primary'>Delete</button>
            </form>
        </div>

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
