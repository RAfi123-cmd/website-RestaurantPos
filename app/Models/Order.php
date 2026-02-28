<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'table_id',
        'user_id',
        'status',
        'opened_at',
        'closed_at'
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    // hitung total harga order
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->qty * $item->price;
        });
    }

    // cek order masih open
    public function isOpen()
    {
        return $this->status === 'open';
    }
}
