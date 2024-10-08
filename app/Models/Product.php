<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name','image_url','description','rating', 'old_price', 'new_price','id_categories','hide'];
    public $timestamps = false;
}
