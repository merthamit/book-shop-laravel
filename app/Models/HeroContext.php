<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroContext extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'hero_context';
}
