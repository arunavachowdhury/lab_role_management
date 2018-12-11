<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $fillable = [
                'name',
                'address',
                'contact_person',
                'phone_number',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function tests()
    {
        return $this->belongsToMany(Lab::class);
    }
}
