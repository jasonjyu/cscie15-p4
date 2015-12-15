{{-- the search form --}}
<form method='get' action='/search' data-transition='none'
    {{-- allow error and debug pages to open with jQuery libraries --}}
      {!! App::environment('local') ? 'data-ajax=\'false\'' : '' !!}>
    <input id='term'
           type='search'
           name='term'
           value='{{ $_GET['term'] or '' }}'
           placeholder='Search for a hashtag...'
           {{ isset($term) ? '' : 'autofocus'}}/>
</form>

{{-- if there are errors, then print them out --}}
@include('layouts.errors')
