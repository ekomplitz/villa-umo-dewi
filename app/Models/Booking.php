<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'check_in',
        'check_out',
        'duration',
        'selected_bungalows',
        'total_price',
        'status',
        'payment_status',
        'transaction_id',
        'order_id',
    ];

    protected $casts = [
        'selected_bungalows' => 'array',
        'check_in' => 'date',
        'check_out' => 'date',
    ];
}