<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $fillable = [
        'name',
        'title',
        'company',
        'email',
        'phone',
        'location',
        'total_employees',
        'industry',
    ];
}
