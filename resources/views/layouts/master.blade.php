<!DOCTYPE html>
<html>
<head>
    <title>
        {{--
        Yield the title if it exists, otherwise default to 'HashTagGregator'
        --}}
        @yield('title','HashTagGregator')
    </title>

    <meta charset='utf-8'/>
    <meta name='viewport' content='maximum-scale=1'/>

    {{-- Required for the Bootstrap CDN library --}}
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'/>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/readable/bootstrap.min.css' rel='stylesheet'/>
    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'>

    {{-- Required for the jQuery Mobile library --}}
    <link href='//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css' rel='stylesheet'/>

    <link href='/css/p4.css' rel='stylesheet'/>
    <link href='/css/posts.css' rel='stylesheet'/>
    <link href='/css/search.css' rel='stylesheet'/>

    {{-- Required for the Bootstrap CDN library --}}
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
    <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    {{-- Required for the jQuery Mobile library --}}
    <script src='http://code.jquery.com/jquery-1.11.3.min.js'></script>
    <script type='text/javascript'>
        $(document).bind('mobileinit', function () {
            $.mobile.ajaxEnabled = false;
        });
    </script>
    <script src='http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js'></script>

    {{--
    Yield any page specific CSS files or anything else you might want in the
    <head>
    --}}
    @yield('head')
</head>
<body>
    <div class='container'>
        @if (\Session::has('flash_message'))
            <div class='flash_message'>
                {!! \Session::get('flash_message') !!}
            </div>
        @endif

        <header>
            <h1>
                <a href='https://www.instagram.com' target='_blank'>
                    <img src='https://instagramstatic-a.akamaihd.net/favicon.ico'/>
                </a>
                <a href='https://twitter.com' target='_blank'>
                    <img src='https://g.twimg.com/dev/documentation/image/Twitter_logo_blue_32.png'/>
                </a>
                HashTagGregator
            </h1>
        </header>

        <nav class='navbar navbar-default'>
            <ul class='nav navbar-nav'>
                <li><a href='/search'>Search</a></li>
                <li><a href='/hashtags'>Hashtags</a></li>
                <li><a href='/posts'>Posts</a></li>
            </ul>
            <ul class='nav navbar-nav navbar-right'>
                {{-- Show links based on if user is authenticated --}}
                @if ($user)
                    <li><a href='/logout'>Logout {{ $user->name }}</a></li>
                @else
                    <li><a href='/login'>Login</a></li>
                    <li><a href='/register'>Register</a></li>
                @endif
            </ul>
        </nav>

        <section class='content'>
            {{-- Main page content will be yielded here --}}
            @yield('content')
        </section>

        <footer>
            &copy; {{ date('Y') }}
            <a href='https://github.com/jasonjyu/cscie15-p4' class='fa fa-github' target='_blank'>View on Github</a>
        </footer>

        {{--
        Yield any page specific JS files or anything else you might want at the
        end of the body
        --}}
        @yield('body')
    </div>
</body>
</html>
