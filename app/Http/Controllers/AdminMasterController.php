<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminMasterController extends Controller
{
    protected $path = 'img/fotouser';

    public function index()
    {
        return view('admin.dashboard');
    }
    public function profile()
    {
        return view('auth.profile');
    }
    public function profile_update(Request $request, User $user)
    {
        $request->validate([
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'file|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        if ($request->foto == null) {
            $foto = $user->foto;
        } else {
            if ($user->foto != 'default.png') {
                File::delete($this->path . '/' . $user->foto);
            }
            $file = $request->file('foto');
            $foto = 'fotouser-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($this->path, $foto);
        }

        if ($request->password == null) {
            $password = $user->password;
        } else {
            $password = Hash::make($request->password);
        }

        User::where('id', $user->id)->update([
            'password' => $password,
            'no_hp' => preg_replace('/\D/', '', $request->no_hp),
            'alamat' => $request->alamat,
            'foto' => $foto,
        ]);
        return redirect()->back()->with('alert', 'Profile berhasil diubah!');
    }
}
