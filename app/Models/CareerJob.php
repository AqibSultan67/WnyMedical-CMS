<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_title',
        'job_type',
        'expired_date',
    ];

}
