<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['term'];

    /**
     * Defines the relationship between this model and the User model.
     */
    public function users()
    {
        // withTimestamps() will ensure the pivot table has its
        // created_at/updated_at fields automatically maintained
        return $this->belongsToMany('\App\User')->withTimestamps();
    }
}
