<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('report');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Report::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'rating' => $request->rating,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Kritik & saran Anda telah terkirim.');
    }

    public function adminIndex()
    {
        $reports = Report::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.reports', compact('reports'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,read,replied',
            'admin_reply' => 'nullable|string',
        ]);
        
        $report->update([
            'status' => $request->status,
            'admin_reply' => $request->admin_reply,
        ]);
        
        return redirect()->back()->with('success', 'Report berhasil diupdate!');
    }

    public function adminDestroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->back()->with('success', 'Report berhasil dihapus!');
    }
}