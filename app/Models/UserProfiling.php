<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfiling extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'birthdate',
        'sex',
        'height',
        'weight',
        'activity_type',
        'terrain',
        'experience_level',
        'maintenance',
        'custom_parts',
    ];
}