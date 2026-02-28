<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'category', 'description'];

    // Relasi: satu menu ada di banyak order item
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
