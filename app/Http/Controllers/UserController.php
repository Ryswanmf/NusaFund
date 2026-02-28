<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);
        return view('admin.donatur.index', compact('users'));
    }

    public function edit(User $donatur)
    {
        return view('admin.donatur.edit', compact('donatur'));
    }

    public function update(Request $request, User $donatur)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'usertype' => 'required|in:user,admin',
        ]);

        $donatur->update([
            'name' => $request->name,
            'usertype' => $request->usertype,
        ]);

        return redirect()->route('admin.donatur.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(User $donatur)
    {
        if ($donatur->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $donatur->delete();
        return redirect()->route('admin.donatur.index')->with('success', 'Akun user telah dihapus!');
    }
}
