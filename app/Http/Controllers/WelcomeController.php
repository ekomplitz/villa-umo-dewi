<?php

namespace App\Http\Controllers;

use App\Models\BungalowSetting;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $bungalows = BungalowSetting::where('status', 'active')->get();
        $lang = session('lang', 'id');
        return view('welcome', compact('bungalows', 'lang'));
    }
}