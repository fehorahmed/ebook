<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryHeader extends Model
{
    use HasFactory;
    protected $table = 'gallery_headers';
    protected $guarded = [];
}
