<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_image',
        'blog_title',
        'slug',
        'blog_description',
        'category',
        'content_images',
    ];

    protected $casts = [
        'content_images' => 'array',
    ];
}
