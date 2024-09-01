<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Novels extends Model
{
    use HasFactory;


    protected $table = 'novels';


    protected $primaryKey = 'novel_id';


    public $timestamps = true;


    protected $fillable = [
        'title',
        'description',
        'cover_image',
        'genre',
        'status'
    ];
}
