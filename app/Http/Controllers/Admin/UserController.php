<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::withCount('chirps')->get(); // Ambil semua pengguna dengan jumlah chirp
        return view('admin.users.index', compact('users'));
    }

    // Menonaktifkan pengguna
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false;
        $user->save();
        return redirect()->route('admin.users.index')->with('status', 'User deactivated successfully.');
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'User deleted successfully.');
    }

    public function setRole(Request $request, $userId)
    {
        // Ambil user yang sedang login
        $loggedInUser = auth()->user();

        // Pastikan admin yang mengubah role, dan tidak memperbolehkan user merubah role mereka sendiri
        if ($loggedInUser->id === $userId) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot change your own role.');
        }

        // Temukan user berdasarkan ID
        $user = User::findOrFail($userId);
        
        // Ambil role berdasarkan nama yang dipilih
        $role = Role::findByName($request->input('role'));

        // Set role untuk user
        $user->syncRoles([$role]);

        // Redirect dengan pesan status
        return redirect()->route('admin.users.index')->with('status', 'Role updated successfully!');
    }
}

