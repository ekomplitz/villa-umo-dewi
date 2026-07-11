<?php

namespace App\Http\Controllers;

use App\Models\BungalowSetting;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Ambil SEMUA bungalow (termasuk inactive)
        $bungalows = BungalowSetting::all();
        $lang = session('lang', 'id');
        return view('welcome', compact('bungalows', 'lang'));
    }
}