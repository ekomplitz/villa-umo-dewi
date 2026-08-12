<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'customer_phone',
        'country_code',
        'customer_email',
        'adults',
        'children',
        'id_type',
        'id_number',
        'check_in',
        'check_out',
        'duration',
        'selected_bungalows',
        'total_price',
        'payment_status',
        'status',
        'notes',
        'booked_by',
        'guests',
    ];

    protected $casts = [
        'guests' => 'array',
    ];

    // Accessor untuk full name
    public function getFullNameAttribute()
    {
        $firstName = $this->first_name ?? 'Customer';
        $lastName = $this->last_name ?? '';
        return trim($firstName . ' ' . $lastName);
    }

    // Accessor untuk daftar tamu
    public function getGuestListAttribute()
    {
        $guests = $this->guests ?? [];
        $list = [];
        foreach ($guests as $index => $guest) {
            $name = trim(($guest['first_name'] ?? '') . ' ' . ($guest['last_name'] ?? ''));
            $list[] = $name ?: 'Tamu ' . ($index + 1);
        }
        return $list;
    }
}