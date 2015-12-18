# Project 4: Final Project

## Live URL
<http://p4.lengjai.me>

## Description
*HashTagGregator* is a web application that searches various social media feeds for a specified hashtag and displays the matching posts. Registered users are able to save posts and manage their searched hashtags.

## Demo
[Screencast Link](https://youtu.be/YAv-VEMqV9k)

## Details for teaching team
For the social media API libraries to work, you first must create application authentication access keys and tokens.
* Instagram: [Developer Platform](https://www.instagram.com/developer/register/)
* Twitter: [Application Management](https://apps.twitter.com/)

Then add the keys and tokens to your .env file:
```shell
INSTAGRAM_CLIENT_ID={ your client id }
INSTAGRAM_CLIENT_SECRET={ your client secret }
INSTAGRAM_CALLBACK_URL=null

TWITTER_CONSUMER_KEY={ your twitter consumer key }
TWITTER_CONSUMER_SECRET={ your twitter consumer secret }
TWITTER_ACCESS_TOKEN={ your twitter access token }
TWITTER_ACCESS_TOKEN_SECRET={ your twitter access token secret }
```

## Outside code / references
* Bootstrap: http://getbootstrap.com/
* Bootstrap Theme: http://bootswatch.com/readable/
* Twitter API for Laravel 4/5: https://github.com/thujohn/twitter
* GET search/tweets - Twitter Developers: https://dev.twitter.com/rest/reference/get/search/tweets
* Twitframe - Embed Tweets in an iframe: https://twitframe.com/
* Instagram PHP API V2: https://github.com/cosenary/Instagram-PHP-API
* Laravel Instagram: https://github.com/vinkla/instagram
* jQuery Mobile Form Input: http://www.w3schools.com/jquerymobile/jquerymobile_form_inputs.asp
