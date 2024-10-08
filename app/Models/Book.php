<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    use HasFactory;

    public function getCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
