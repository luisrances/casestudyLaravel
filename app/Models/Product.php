<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'image_path',
    ];

    // public function getImageUrlAttribute()
    // // {
    // //     if ($this->image_path) {
    // //         return asset('storage/' . $this->image_path);
    // //     }
    // //     return asset('Images/default.jpg');
    // // }

    // {
    //     $imagePath = 'storage/Image/' . $this->image; // Adjust if your column or folder is different

    //     if ($this->image && file_exists(public_path($imagePath))) {
    //         return asset($imagePath);
    //     }

    //     return asset('storage/image/default.jpg');
    // }
}
