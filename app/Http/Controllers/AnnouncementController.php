<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('admin')->latest()->paginate(15);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'isi'            => 'required|string',
            'tanggal_publish'=> 'required|date',
            'is_active'      => 'boolean',
        ]);

        Announcement::create([
            'admin_id'       => Auth::id(),
            'judul'          => $request->judul,
            'isi'            => $request->isi,
            'tanggal_publish'=> $request->tanggal_publish,
            'is_active'      => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'isi'            => 'required|string',
            'tanggal_publish'=> 'required|date',
            'is_active'      => 'boolean',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update([
            'judul'          => $request->judul,
            'isi'            => $request->isi,
            'tanggal_publish'=> $request->tanggal_publish,
            'is_active'      => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
