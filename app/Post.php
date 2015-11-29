<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** The feed name for the Twitter. */
    const FEED_TWITTER = "twitter";

    /** The feed name for the Instagram. */
    const FEED_INSTAGRAM = "instagram";
}
