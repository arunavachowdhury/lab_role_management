<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    public $fillable = [
        'name',
        'description'
    ];

    public function ISStandards() {
        return $this->hasMany(ISStandard::class);
    }

    public function TestItems() {
        return $this->hasMany(TestItem::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
