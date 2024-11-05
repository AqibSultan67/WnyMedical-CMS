<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDocument extends Model
{
    use HasFactory;

    protected $table = 'patient_documents';


    protected $fillable = [
        'file_name',
        'file_path'
    ];
}
