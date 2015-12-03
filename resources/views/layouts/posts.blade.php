{{-- if $posts is not empty, then display the posts --}}
@if (!empty($posts))
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                @if ($post->provider == \App\Post::PROVIDER_TWITTER)
                    {!! Oembed::get($post->uri)->code !!}
                @elseif ($post->provider == \App\Post::PROVIDER_INSTAGRAM)
                    <iframe class='instagram-media'
                            src='{{ $post->uri }}embed/captioned/'
                            frameborder='0'
                            width='500'
                            height='720'>
                    </iframe>
                @else
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
                @endif
            </div>
        @endforeach
    </div>
@endif
