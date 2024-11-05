<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_title',
        'slug',
        'service_description',
        'cover_image',
        'category',
        'content_images',
    ];

    protected $casts = [
        'content_images' => 'array',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            $service->slug = Str::slug($service->service_title);
        });

        static::updating(function ($service) {
            $service->slug = Str::slug($service->service_title);
        });
    }
}
