<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Defines the relationship between this model and the Hashtag model.
     */
    public function hashtags()
    {
        // define one-to-many relationship (a user has many hashtags)
        return $this->hasMany('\App\Hashtag');
    }

    /**
     * Defines the relationship between this model and the Post model.
     */
    public function posts()
    {
        // define many-to-many relationship (many users have many hashtags),
        // withTimestamps() will ensure the pivot table has its
        // created_at/updated_at fields automatically maintained
        return $this->belongsToMany('\App\Post')->withTimestamps();
    }
}
