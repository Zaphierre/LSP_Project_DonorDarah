<?php
namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'tanggal_publish' => 'required|date',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'admin_id'        => Auth::id(),
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_publish' => $request->tanggal_publish,
            'is_active'       => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('announcements', 'public');
        }

        Announcement::create($data);
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
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'tanggal_publish' => 'required|date',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $announcement = Announcement::findOrFail($id);
        $data = [
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'tanggal_publish' => $request->tanggal_publish,
            'is_active'       => $request->boolean('is_active'),
        ];

        if ($request->hasFile('gambar')) {
            if ($announcement->gambar) {
                Storage::disk('public')->delete($announcement->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('announcements', 'public');
        }

        $announcement->update($data);
        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        if ($announcement->gambar) {
            Storage::disk('public')->delete($announcement->gambar);
        }
        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
