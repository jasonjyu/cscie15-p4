<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** The provider name for Instagram. */
    const PROVIDER_INSTAGRAM = 'instagram';

    /** The provider name for Twitter. */
    const PROVIDER_TWITTER = 'twitter';
}
