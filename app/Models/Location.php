<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'phone',
        'address',
        'days',
        'description',
        'times',
        'link',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->slug = Str::slug($location->location);
        });
    }



}
