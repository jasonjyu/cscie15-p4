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
    protected $fillable = ['term', 'user_id'];

    /**
     * Defines the relationship between this model and the User model.
     */
    public function user()
    {
        // define many-to-one relationship (a hashtag belongs to a user)
        return $this->belongsTo('\App\User');
    }
}
