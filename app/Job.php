<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $fillable = [
        'test_id',
        'test_item_id',
        'test_item_name',
        'lab_id',
        'user_id',
        'ref_lab_id',
        'ref_user_id',
        'modified_by',
        'price',
        'specified_range_from',
        'specified_range_to',
        'observed_value',
        'in_range',
        'lab_id',
        'is_new'
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function testItem()
    {
        return $this->belongsTo(TestItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
