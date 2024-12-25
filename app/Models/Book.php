<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Session;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $guarded = [];

    public function writer(){
        return $this->belongsTo(Writer::class, 'writer_id', 'id');
    }
    public function category(){
        return $this->belongsTo(BookCategory::class, 'category_id', 'id');
    }

    public function bookPageContent() {
        return $this->hasMany(BookPageContent::class,'book_id','id');
    }

    public function user() {
        return $this->hasMany(User::class);
    }
    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isUserLike(){
        return $this->likes()->where('user_id',  Session::get('customerId'))->exists();
     }
}
