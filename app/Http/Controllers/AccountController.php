<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $path = 'img/fotouser';

    public function pelanggan()
    {
        $users = User::where('role_id', 3)->get();
        return view('admin.pelanggan', compact('users'));
    }
    public function karyawan()
    {
        $users = User::where('role_id', 2)->get();
        return view('admin.karyawan', compact('users'));
    }
    public function role()
    {
        $users = User::all();
        return view('admin.role', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_hp' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'file|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        if ($request->foto == null) {
            $foto = 'default.png';
        } else {
            $file = $request->file('foto');
            $foto = 'fotouser-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($this->path, $foto);
        }


        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => preg_replace('/\D/', '', $request->no_hp),
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $foto,
            'role_id' => $request->_role
        ]);
        return redirect()->back()->with('alert', 'Data user berhasil ditambahkan!');
    }
    public function update(Request $request, User $akun)
    {
        $request->validate([
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'file|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        if ($request->foto == null) {
            $foto = $akun->foto;
        } else {
            if ($akun->foto != 'default.png') {
                File::delete($this->path . '/' . $akun->foto);
            }
            $file = $request->file('foto');
            $foto = 'fotouser-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($this->path, $foto);
        }

        if ($request->password == null) {
            $password = $akun->password;
        } else {
            $password = Hash::make($request->password);
        }

        User::where('id', $akun->id)->update([
            'password' => $password,
            'no_hp' => preg_replace('/\D/', '', $request->no_hp),
            'alamat' => $request->alamat,
            'foto' => $foto,
        ]);
        return redirect()->back()->with('alert', 'Data user berhasil diubah!');
    }
    public function destroy(User $akun)
    {
        if ($akun->foto != 'default.png') {
            File::delete($this->path . '/' . $akun->foto);
        }
        User::destroy('id', $akun->id);
        return redirect()->back()->with('alert', 'Data user berhasil dihapus!');
    }
    public function role_update(Request $request, User $akun)
    {
        User::where('id', $akun->id)->update(['role_id' => $request->role_id]);
        return redirect()->back()->with('alert', 'Role user berhasil diubah!');
    }
}
