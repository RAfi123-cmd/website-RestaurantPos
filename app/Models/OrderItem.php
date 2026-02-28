<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['order_id', 'menu_id', 'quantity', 'price', 'subtotal'];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];
    // Relasi: item milik satu order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: item mereferensi satu menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
