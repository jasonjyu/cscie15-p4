<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** The provider name for Instagram. */
    const PROVIDER_INSTAGRAM = 'instagram';

    /** The provider name for Twitter. */
    const PROVIDER_TWITTER = 'twitter';

    /**
     * Sorts posts by specified comparison function.
     *
     * @param  array|object $posts posts array to sort
     */
    public static function sortPosts(array &$posts, $sort_func)
    {
        usort($posts, 'self::'.$sort_func);
    }

    /**
     * Sorts posts by newest first.
     *
     * @param  object $a first post object to compare
     * @param  object $b second post object to compare
     */
    protected static function sortByNewest(Post $a, Post $b)
    {
        return $b->source_time - $a->source_time;
    }

    /**
     * Sorts posts by oldest first.
     *
     * @param  object $a first post object to compare
     * @param  object $b second post object to compare
     */
    protected static function sortByOldest(Post $a, Post $b)
    {
        return $a->source_time - $b->source_time;
    }
}
