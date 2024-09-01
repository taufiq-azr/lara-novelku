<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    use HasFactory;

    protected $table = 'chapters';

    protected $primaryKey = 'chapter_id';

    public $timestamps = true;

    protected $fillable = [
        'novel_id',
        'title',
        'content',
        'chapter_number',
    ];
}
