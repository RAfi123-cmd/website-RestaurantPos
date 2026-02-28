<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use SoftDeletes;

    protected $fillable = ['order_id', 'file_path', 'generated_at'];

    protected $casts = [
        'generated_at' => 'datetime',
    ];

    // Relasi: struk untuk satu order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
