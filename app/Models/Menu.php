<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'category_id', 'photo', 'description'];

    // Relasi: satu menu ada di banyak order item
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPhotoAttribute($value)
    {
        if(!$value){
            return null;
        }

        return url(Storage::url($value));
    }
}
