<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\TempatKuliner;
use App\Models\User;

class SuperAdminController extends Controller
{
    public function index()
    {
        $wisata = TempatWisata::with(['kategori', 'jamOperasionalAdmin', 'foto'])->get();
        $kuliner = TempatKuliner::with(['kategori', 'jamOperasionalAdmin', 'foto'])->get();

        return view('superadmin.dashboard', compact('wisata', 'kuliner'));
    }

    public function indexAdmin()
    {
        $admins = User::where('role', 'Admin')->get();
        return view('superadmin.admin.index', compact('admins'));
    }

    public function createAdmin()
    {
        return view('superadmin.admin.create');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:Super Admin,Admin,User',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('superadmin.admin.index')
            ->with('success', 'Admin berhasil ditambahkan.');
    }

    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('superadmin.admin.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $admin->id,
            'password' => 'nullable|confirmed|min:6',
            'role' => 'required|in:Admin,Super Admin',
        ]);

        $admin->username = $request->username;
        $admin->role = $request->role;

        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->route('superadmin.admin.index')
            ->with('success', 'Admin berhasil diperbarui.');
    }

    // ✅ FIXED: Changed from destroyAdmin to deleteAdmin (match with route)
    public function deleteAdmin($id)
    {
        $admin = User::where('role', 'Admin')->findOrFail($id);
        $admin->delete();

        return redirect()->route('superadmin.admin.index')
            ->with('success', 'Admin berhasil dihapus.');
    }
}
