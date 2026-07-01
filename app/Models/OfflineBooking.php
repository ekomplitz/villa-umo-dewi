<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'customer_phone', 'customer_email',
        'check_in', 'check_out', 'duration', 'selected_bungalows',
        'total_price', 'notes', 'payment_status', 'status', 'booked_by'
    ];

    protected $casts = [
        'selected_bungalows' => 'array',
    ];
}