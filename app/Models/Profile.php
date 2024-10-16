<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username', 'email', 'phone', 'address', 'current_password', 'new_password', 'confirm_new_password', 'profile_picture'
    ];

}
