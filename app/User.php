<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','campuses','position','picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getDefaultCampuses() :array
    {
        return ['Tandag','Cantilan','San Miguel','Cagwait','Lianga','Tagbina','Bislig'];
    }

    public function researchCards()
    {
        return $this->hasMany('App\ResearchCard', 'user_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) 
        {
            foreach ($roles as $role) 
            {
                if ($this->hasRole($role)) 
                {
                    return true;
                }
            }
        }
        else
        {
            if ($this->hasRole($roles)) 
            {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) 
        {
            return true;
        }
        return false;
    }

}
