<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'recipient_name',
        'phone_number',
        'district',
        'city',
        'region',
        'street',
        'address_category',
    ];

    // Optional: if a payment detail belongs to an account
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
