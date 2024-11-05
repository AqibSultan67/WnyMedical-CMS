<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services_Title_Image extends Model
{
    use HasFactory;
    protected $table = 'services_title_image';
    protected $fillable = ['image'];
}
