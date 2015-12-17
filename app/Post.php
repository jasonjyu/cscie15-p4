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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['provider', 'uri', 'source_time', 'text'];

    /**
     * Defines the relationship between this model and the User model.
     */
    public function users()
    {
        // define many-to-many relationship (many posts have many users),
        // withTimestamps() will ensure the pivot table has its
        // created_at/updated_at fields automatically maintained
        return $this->belongsToMany('\App\User')->withTimestamps();
    }

    /**
     * Sorts posts by specified comparison function.
     *
     * @param  array|object $posts posts array to sort
     * @param  string       $sort_func   sort function to apply on the posts
     */
    public static function sortPosts(array &$posts, $sort_func = null)
    {
        // if $sort_func is null, then apply default sort function
        if (is_null($sort_func)) {
            $sort_func = 'sortByNewest';
        }

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
        return strcmp($b->source_time, $a->source_time);
    }

    /**
     * Sorts posts by oldest first.
     *
     * @param  object $a first post object to compare
     * @param  object $b second post object to compare
     */
    protected static function sortByOldest(Post $a, Post $b)
    {
        return strcmp($a->source_time, $b->source_time);
    }
}
