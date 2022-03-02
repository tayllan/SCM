<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCart extends Model
{
    use HasFactory;

    public function item()
    {
        return $this->hasOne(Item::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
