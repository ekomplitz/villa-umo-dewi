<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'adults',
        'children',
        'id_type',
        'id_number',
        'guests',
        'check_in',
        'check_out',
        'duration',
        'selected_bungalows',
        'total_price',
        'status',
        'payment_status',
        'order_id',
        'transaction_id',
    ];

    protected $casts = [
        'guests' => 'array',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ($this->last_name ? ' ' . $this->last_name : '');
    }
}