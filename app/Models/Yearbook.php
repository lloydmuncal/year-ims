<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yearbook extends Model
{
    use HasFactory, SoftDeletes;
    // protected $table="yearbooks";
    protected $fillable = [
        'Yearbook_id',
        'Title', // Add this line
        'Batch',
        'FileName',
        'Name',
        'EXT',
        'Overide',
        'SelectedCover',
        'SelectedBackground',
        'Section',
        'Page',
        'Gallery',
        'pic',
    ];
}
