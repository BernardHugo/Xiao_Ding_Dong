<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = 'checkout';

    protected $primaryKey = 'checkout_id';

    protected $fillable = [
        'full_name', 'phone', 'address', 'city', 'country', 'card_name', 'card_number', 'zip'
    ];

    public function user(){
        return $this->hasMany(User::class, "id", "checkout_id");
    }

    public function transaction(){
        return $this->hasMany(Transaction::class, "transaction_id", "checkout_id");
    }
}
