<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';

    protected $fillable = [
        'name', 'type', 'image', 'price', 'brief_description', 'about'
    ];

    protected $primaryKey = 'id';

    public function cart(){
        return $this->hasMany(Cart::class, "cart_id", "id");
    }

    public function user(){
        return $this->hasMany('User');
    }
}
