<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'contact_person',
    ];

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
