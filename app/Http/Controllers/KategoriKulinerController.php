<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriKuliner;
use Illuminate\Support\Facades\Log;

class KategoriKulinerController extends Controller
{
    public function index()
    {
        $kategori = KategoriKuliner::orderBy('created_at', 'desc')->get();
        return view('kategori_kuliner.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_kuliner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_kuliner,nama_kategori',
            'status' => 'nullable|boolean',
        ]);

        try {
            KategoriKuliner::create([
                'nama_kategori' => $validated['nama_kategori'],
                'status' => $validated['status'] ?? true,
            ]);

            return redirect()->route('kategori-kuliner.index')
                ->with('success', 'Kategori kuliner berhasil ditambahkan');
        } catch (\Throwable $e) {
            Log::error('Error creating kategori kuliner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    public function edit($id)
    {
        $kategori = KategoriKuliner::findOrFail($id);
        return view('kategori_kuliner.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriKuliner::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_kuliner,nama_kategori,' . $id . ',id_kategori',
            'status' => 'nullable|boolean',
        ]);

        try {
            $kategori->update([
                'nama_kategori' => $validated['nama_kategori'],
                'status' => $validated['status'] ?? $kategori->status,
            ]);

            return redirect()->route('kategori-kuliner.index')
                ->with('success', 'Kategori kuliner berhasil diperbarui');
        } catch (\Throwable $e) {
            Log::error('Error updating kategori kuliner: ' . $e->getMessage());

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data.']);
        }
    }

    public function destroy($id)
    {
        try {
            $kategori = KategoriKuliner::findOrFail($id);

            // Check if kategori is being used by any tempat kuliner
            if ($kategori->tempatKuliner()->count() > 0) {
                return back()->withErrors([
                    'error' => 'Kategori tidak dapat dihapus karena masih digunakan oleh ' .
                               $kategori->tempatKuliner()->count() . ' tempat kuliner.'
                ]);
            }

            $kategori->delete();

            return redirect()->route('kategori-kuliner.index')
                ->with('success', 'Kategori kuliner berhasil dihapus');
        } catch (\Throwable $e) {
            Log::error('Error deleting kategori kuliner: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $kategori = KategoriKuliner::findOrFail($id);
            $kategori->update(['status' => !$kategori->status]);

            return back()->with('success', 'Status kategori berhasil diubah');
        } catch (\Throwable $e) {
            Log::error('Error toggling kategori kuliner status: ' . $e->getMessage());

            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengubah status.']);
        }
    }
}
