<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_category';
    protected $table = 'categories';
    protected $fillable = ['id_category','name'];
}
