<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $primaryKey = 'cart_id';

    protected $fillable = [
        'food_id', 'user_id', 'quantity', 'is_paid'
    ];

    public function food(){
        return $this->hasMany(Food::class, "id", "cart_id");
    }

    public function transaction(){
        return $this->hasMany(Transaction::class, "transaction_id", "cart_id");
    }
}
