<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;

    protected $fillable = [
        'steps',
        'description',
        'images', // Assuming this is stored as a JSON array
        'app'
    ];

    protected $casts = [
        'steps' => 'array',
        'description' => 'array',
        'images' => 'array', // Ensure this is cast to array
        'app' => 'string', // If app is a single string value
    ];
}
