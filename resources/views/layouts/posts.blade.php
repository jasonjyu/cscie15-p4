{{-- if $posts is not empty, then display the posts --}}
@if (!empty($posts))
    <div class='posts'>
        @foreach ($posts as $post)
            <span class='post'>
                @if ($post->provider == \App\Post::PROVIDER_INSTAGRAM)
                    <iframe class='instagram-media'
                            src='{{ $post->uri }}embed/captioned/'
                            frameborder='0'
                            height='480'>
                    </iframe>
                @elseif ($post->provider == \App\Post::PROVIDER_TWITTER)
                    {{-- {!! Oembed::cache($post->uri, [])->code !!} --}}
                    <iframe class='twitter-tweet'
                            src='http://twitframe.com/show?url={{ urlencode($post->uri) }}'
                            frameborder='0'
                            height='480'>
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
            </span>
        @endforeach

        {{--
        @foreach ($posts as $post)
            <a class='embedly-card' href='{{ $post->uri }}'></a>
        @endforeach
        <script src='//cdn.embedly.com/widgets/platform.js' async></script>
        --}}
    </div>
@endif
