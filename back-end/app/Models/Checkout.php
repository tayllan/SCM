<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_price',
    ];

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
