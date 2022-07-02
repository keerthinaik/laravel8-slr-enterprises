<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function item_category()
    {
        return $this->hasOne(ItemCategory::class, 'id','item_category_id');
    }
}
