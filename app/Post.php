<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** The feed name for Twitter. */
    const FEED_TWITTER = "twitter";

    /** The feed name for Instagram. */
    const FEED_INSTAGRAM = "instagram";
}
