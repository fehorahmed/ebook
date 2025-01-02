<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdSetting extends Model
{
    use HasFactory;
    protected $table = 'ad_settings';
    protected $guarded = [];
}
