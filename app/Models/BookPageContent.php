<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookPageContent extends Model
{
    use HasFactory;
    protected $table = 'book_page_contents';
    protected $guarded = [];
}
