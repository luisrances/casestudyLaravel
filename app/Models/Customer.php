<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define fillable attributes for mass assignment
    protected $fillable = ['name', 'age', 'email'];
}
