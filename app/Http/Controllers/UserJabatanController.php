<?php

namespace App\Http\Controllers;

use App\Models\jabatan;
use App\Models\User;
use Illuminate\Http\Request;

class UserJabatanController extends Controller
{
    public function ubahRole()
    {
        $users = User::all();
        return view('admin.ubahRole', ['users' => $users]);
    }
    public function tambahRole()
    {
        $jabatans = jabatan::get();
        return view('admin.tambahRole', ['jabatans' => $jabatans]);
    }
    public function addRole(Request $request)
    {
        $request->validate([
            'NamaJabatan' => 'required',
        ]);
        $jabatan = Jabatan::create([
            'NamaJabatan' => $request->NamaJabatan,
        ]);
        return redirect()->route('tambah-role')->with('success', 'Jabatan berhasil ditambahkan');
    }
}
