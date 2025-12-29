<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'button_text',
        'button_url',
        'image',
        'video',
        'status',
    ];
}