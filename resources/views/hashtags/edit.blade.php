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
    <link href='/css/hashtags.css' rel='stylesheet'/>
@stop

@section('content')
    <h2>Edit Hashtags</h2>

    {{-- if there are hashtags, then display the hashtag terms --}}
    @if (isset($hashtags) && count($hashtags) > 0)
        {{-- check for an error with any of the hashtags --}}
        <?php $error_id = \Session::pull('error_hashtag_edit_id'); ?>
        <p>
            <a href='/hashtags' data-transition='none'
               {!! isset($error_id) ? 'data-ajax=\'false\'' : '' !!}>View</a>
            |
            <a href='/hashtags/delete' data-transition='none'
               {!! isset($error_id) ? 'data-ajax=\'false\'' : '' !!}>Delete</a>
            |
            Edit
        </p>
        <div class='hashtags'>
            <legend>Edit hashtags to update:</legend>
            <form method='post' action='/hashtags/edit' data-transition='none'
                  data-ajax='false'>
                {!! csrf_field() !!}
                <div class='form-group'>
                    @foreach ($hashtags as $hashtag)
                        <input type='text'
                               name='edited_hashtags[{{ $hashtag->id }}]'
                               value='{{ $_POST['edited_hashtags'][$hashtag->id] or $hashtag->term }}'
                               placeholder='{{ $hashtag->term }}'
                               {!! $hashtag->id == $error_id ? 'class=\'error\'' : '' !!}/>
                    @endforeach
                </div>
                <button type='submit' class='btn btn-primary'>Update</button>
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
