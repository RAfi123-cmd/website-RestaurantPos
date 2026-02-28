<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = ['order_id', 'amount', 'method', 'status', 'paid_at'];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // Relasi: pembayaran untuk satu order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
