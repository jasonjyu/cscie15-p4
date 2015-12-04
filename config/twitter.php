<?php

return [

    'base_url'    => 'https://api.twitter.com/',

    'api_version' => '1.1',

    'api_key'     => function_exists('env') ? env('TWITTER_CONSUMER_KEY', '') : '',

    'api_secret'  => function_exists('env') ? env('TWITTER_CONSUMER_SECRET', '') : '',

];
