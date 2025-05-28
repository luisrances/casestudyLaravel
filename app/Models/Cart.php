<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'account_id',
        'quantity',
    ];

    // Define the relationship with the Product model.
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Define the relationship with the Account model.  It's good practice to name this 'account'
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
    //You may want to add methods to your model, but this is handled better in a service class
}
