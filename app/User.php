<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const USER_ADMIN = 'admin';
    const USER_TECHNICIAN = 'technician';
    const USER_DIRECTOR = 'director';
    const USER_EMPLOYEE = 'employee';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
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
     * Tells if the user is a USER_ADMIN type user
     *
     * @return boolean
     */
    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        } else {
            if($this->hasRole($role))
                {
                    return true;
                }
        }
        return false;
    }

    public function hasRole($role)
    {
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    /**
     * Tells if the user is a USER_DIRECTOR type user
     *
     * @return boolean
     */
    public function isUserDirector()
    {
        // return $this->usertype == User::USER_DIRECTOR;
    }

    public function isUserTechnician()
    {
        // return $this->usertype == User::USER_TECHNICIAN;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function labs()
    {
        return $this->belongsToMany(Lab::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }    
}
