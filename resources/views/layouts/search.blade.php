{{-- the search form --}}
<form method='get' action='/search'>
    <input type='search'
           name='term'
           value='{{ $_GET['term'] or '' }}'
           placeholder='Search for a hashtag...'
           {{ isset($term) ? '' : 'autofocus'}}/>
</form>

{{-- if there are errors, then print them out --}}
@include('layouts.errors')
