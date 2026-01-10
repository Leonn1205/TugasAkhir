<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriWisata;
use Illuminate\Support\Facades\Log;

class KategoriWisataController extends Controller
{
    public function index()
    {
        $kategori = KategoriWisata::orderBy('created_at', 'desc')->get();
        return view('kategori_wisata.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_wisata.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_wisata,nama_kategori',
            'status' => 'nullable|boolean',
        ], [
            'nama_kategori.required' => 'Nama kategori wisata wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan. Silakan gunakan nama lain.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter',
        ]);

        try {
            KategoriWisata::create([
                'nama_kategori' => $validated['nama_kategori'],
                'status' => $validated['status'] ?? true,
            ]);

            return redirect()->route('kategori-wisata.index')
                ->with('success', 'Kategori wisata berhasil ditambahkan');
        } catch (\Throwable $e) {
            Log::error('Error creating kategori wisata: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $kategori = KategoriWisata::findOrFail($id);
            $kategori->update(['status' => !$kategori->status]);

            return back()->with('success', 'Status kategori berhasil diubah');
        } catch (\Throwable $e) {
            Log::error('Error toggling kategori wisata status: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengubah status.']);
        }
    }
}
