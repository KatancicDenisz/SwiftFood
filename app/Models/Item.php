<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable  = ['name','description','price','image_url'];

    public function orderedItems()
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

}
