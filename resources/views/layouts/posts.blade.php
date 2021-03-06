{{-- if there are posts, then display the posts --}}
@if (isset($posts) && count($posts) > 0)
    <div class='posts'>
        {{--  if there are sort_by names, then display the posts sort form --}}
        @if (isset($posts_sort_by_names) && count($posts_sort_by_names))
            <form id='sort' method='post' action='/posts/sort'>
                {!! csrf_field() !!}

                {{-- the sort select menu --}}
                <fieldset class='ui-field-contain'>
                    <label for='sort_by'>Sort By:</label>
                    <select id='sort_by' name='sort_by'
                            onchange='this.form.submit()'>
                        @foreach ($posts_sort_by_names as $sort_by_name)
                            <option value='{{ $sort_by_name }}'
                                    {{ \Session::get('sort_by') ==
                                    $sort_by_name ? 'selected' : '' }}>
                                {{-- assume sort_by_name is prefixed with
                                     'sortBy' --}}
                                {{ substr($sort_by_name, 6) }}
                            </option>
                        @endforeach
                    </select>
                </fieldset>
            </form>
        @endif

        @foreach ($posts as $post)
            {{-- if post id exists, then display an anchor to jump to --}}
            @if ($post->id)
                <a id ='{{ $post->id }}' class='anchor' name='{{ $post->id }}'>
                    {{ $post->id }}
                </a>
            @endif
            <div class='post'>
                {{-- display form only if specified --}}
                @if (!empty($posts_enable_form))
                    {{-- if post id exists, then display the unsave form --}}
                    @if ($post->id)
                        <form method='post' action='/posts/delete'>
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
                        <form method='post' action='/posts/create'>
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
