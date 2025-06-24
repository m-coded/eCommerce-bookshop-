<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class novelsbooks extends Model
{
    protected $table = 'novelsbooks';
    protected $fillable = ['description', 'author', 'image_url', 'price'];
    use HasFactory;
}
