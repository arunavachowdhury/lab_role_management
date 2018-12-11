<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ISStandard extends Model
{
    public $fillable = [
        'value',
        'sample_id'
    ];

    public function sample() {
        return $this->belongsTo(Sample::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function testItems()
    {
        return $this->hasMany(TestItem::class);
    }


}
