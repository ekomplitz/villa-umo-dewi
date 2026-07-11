<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- TAMBAHKAN INI!

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderBy('order', 'asc')->get();
        return view('gallery', compact('galleries'));
    }

    // Admin: kelola gallery
    public function adminIndex()
    {
        $galleries = Gallery::orderBy('order', 'asc')->get();
        return view('admin.galleries', compact('galleries'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Foto berhasil ditambahkan!');
    }

    public function adminDestroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Hapus file gambar dari storage
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}