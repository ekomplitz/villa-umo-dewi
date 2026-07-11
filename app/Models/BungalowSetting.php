<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BungalowSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'name', 'description_id', 'description_en', 'price', 'image', 'status'
    ];

    public function getDescription($lang = 'id')
    {
        if ($lang === 'en' && $this->description_en) {
            return $this->description_en;
        }
        return $this->description_id ?? $this->description_en;
    }
}