<?php
// app/Models/BungalowSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BungalowSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'code', 
        'description_id', 
        'description_en', 
        'image', 
        'images',      // Tambahkan
        'price', 
        'discount_price', // Tambahkan
        'status'
    ];

    protected $casts = [
        'images' => 'array', // Otomatis cast ke array
    ];

    public function getDescription($lang = 'id')
    {
        if ($lang === 'en' && $this->description_en) {
            return $this->description_en;
        }
        return $this->description_id ?? $this->description_en;
    }

    // Accessor untuk mendapatkan semua gambar (termasuk gambar utama)
    public function getAllImagesAttribute()
    {
        $images = $this->images ?? [];
        if ($this->image) {
            array_unshift($images, $this->image);
        }
        return array_filter($images);
    }

    // Cek apakah ada diskon
    public function getHasDiscountAttribute()
    {
        return $this->discount_price && $this->discount_price > 0 && $this->discount_price < $this->price;
    }
}