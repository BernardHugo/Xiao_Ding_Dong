<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'cart_id', 'checkout_id', 'purchase_date'
    ];

    public function cart(){
        return $this->hasMany(Cart::class, "cart_id", "transaction_id");
    }

    public function checkout(){
        return $this->hasMany(Checkout::class, "checkout_id", "transaction_id");
    }
}
