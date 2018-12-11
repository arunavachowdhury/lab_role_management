<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    public $fillable = [
        'unit',
    ];
    
    public function testItems() {
        return $this->hasOne(TestItem::class);
    }
}
