<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_email',
        'student_name', 'date_of_birth', 'class', 'performance',
        'attendance', 'contact', 'status', 'address'
    ];

}
