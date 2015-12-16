{{-- if there are posts, then display the posts --}}
@if (isset($posts) && count($posts) > 0)
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                {{-- display form only if user is authenticated --}}
                @if (isset($user))
                    {{-- if post id exists, then display the unsave form --}}
                    @if ($post->id)
                        <form method='post'
                              action='/posts/delete'
                              data-transition='none'
                              data-ajax='false'>
                            {!! csrf_field() !!}
                            <input type='hidden'
                                   name='post_id'
                                   value='{{ $post->id }}'/>
                            <button type='submit' class='btn btn-danger'>
                                Unsave
                            </button>
                        </form>
                    {{-- otherwise, display the save form --}}
                    @else
                        <form method='post'
                              action='/posts/create'
                              data-transition='none'
                              data-ajax='false'>
                            {!! csrf_field() !!}
                            <input type='hidden'
                                   name='provider'
                                   value='{{ $post->provider }}'/>
                            <input type='hidden'
                                   name='uri'
                                   value='{{ $post->uri }}'/>
                            <input type='hidden'
                                   name='source_time'
                                   value='{{ $post->source_time }}'/>
                            <input type='hidden'
                                   name='text'
                                   value='{{ $post->text }}'/>
                            <button type='submit' class='btn btn-primary'>
                                Save
                            </button>
                        </form>
                    @endif
                @endif

                {{-- display post based on provider type --}}
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
                    {!! $post->text !!}
                    <br/>
                    <a href='{{ $post->uri }}' target='_blank'>
                        {{ $post->source_time }}
                    </a>
                    {{ $post->feed }}
                @endif
            </div>
        @endforeach

        {{--
        @foreach ($posts as $post)
            <a class='embedly-card' href='{{ $post->uri }}'></a>
        @endforeach
        <script src='//cdn.embedly.com/widgets/platform.js' async></script>
        --}}
    </div>
@endif
