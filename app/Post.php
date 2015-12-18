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
        // created_at/updated_at fields automatically maintained,
        // withPivot('id') will add the pivot ID information
        return $this->belongsToMany('\App\User')->withTimestamps()->withPivot(
            'id');
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
            $sort_func = self::getSortFunctionNames()[0];
        }

        usort($posts, 'self::'.$sort_func);
    }

    /**
     * Gets all the existing sort function names for posts.
     *
     * @example array($func1, $func2, $func3)
     * @param  boolean $include_saved_posts include sort function names intended
     *                                      only for saved posts
     * @return array|object
     */
    public static function getSortFunctionNames($include_saved_posts = false)
    {
        // base sort function names
        $sort_func_names = [
            'sortByNewest',
            'sortByOldest',
        ];

        // check whether to include sort function names for saved posts
        if ($include_saved_posts) {
            $sort_func_names[] = 'sortByRecentlySaved';
        }

        return $sort_func_names;
    }

    /**
     * Sorts posts by newest source time first.
     *
     * @param  \App\Post $a first post to compare
     * @param  \App\Post $b second post to compare
     */
    protected static function sortByNewest(Post $a, Post $b)
    {
        return strcmp($b->source_time, $a->source_time);
    }

    /**
     * Sorts posts by oldest source time first.
     *
     * @param  \App\Post $a first post to compare
     * @param  \App\Post $b second post to compare
     */
    protected static function sortByOldest(Post $a, Post $b)
    {
        return strcmp($a->source_time, $b->source_time);
    }

    /**
     * Sorts posts by most recently saved first.
     *
     * @param  \App\Post $a first post to compare
     * @param  \App\Post $b second post to compare
     */
    protected static function sortByRecentlySaved(Post $a, Post $b)
    {
        // if pivot ID are null, then apply default sort function
        if (is_null($a->pivot) || is_null($a->pivot->id) ||
            is_null($b->pivot) || is_null($b->pivot->id)) {
            return call_user_func('self::'.self::getSortFunctionNames()[0], $a,
                $b);
        }

        return $b->pivot->id - $a->pivot->id;
    }
}
