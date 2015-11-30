{{-- if $posts is not empty, then display the posts --}}
@if (!empty($posts))
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                @if (isset($post->media_uri))
                    <div class='media'>
                        <img src='{{ $post->media_uri }}'/>
                    </div>
                @endif
                {!! $post->text !!}
                <br/>
                <a href='{{ $post->uri }}' target='_blank'>
                    {{ $post->source_time }}
                </a>
                {{ $post->feed }}
            </div>
        @endforeach
    </div>
@endif
