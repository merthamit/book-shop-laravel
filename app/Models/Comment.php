<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comment';
    public function getUserName()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function getBookName()
    {
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }
}
