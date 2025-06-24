<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class popularbooks extends Model
{
    protected $table = 'popularbooks';
    protected $fillable = ['description', 'author', 'image_path', 'price'];
    use HasFactory;
}
