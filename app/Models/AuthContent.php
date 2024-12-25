<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthContent extends Model
{
    use HasFactory;
    protected $table = 'auth_contents';
    protected $guarded = [];
}
