@extends('layouts.master')

{{--
This `head` section will be yielded right before the closing </head> tag.
Use it to add specific things that *this* View needs in the head,
such as a page specific styesheets.
--}}
@section('head')
    <link href='/css/home.css' type='text/css' rel='stylesheet'/>
@stop

@section('content')
    <form method='get' action='/search' data-transition='none'
          data-ajax='false'>
        <input id='search' type='search' name='search'
               placeholder='Search for a hashtag...'>
        <input type='submit' data-inline='true' value='Search'>
    </form>
@stop

{{--
This `body` section will be yielded right before the closing </body> tag.
Use it to add specific things that *this* View needs at the end of the body,
such as a page specific JavaScript files.
--}}
@section('body')
    {{-- <script src='/js/home.js'></script> --}}
@stop
