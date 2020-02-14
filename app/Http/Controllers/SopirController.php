<?php

namespace App\Http\Controllers;

use App\Sopir;
use Illuminate\Http\Request;

class SopirController extends Controller
{
    public function index()
    {
        $jumlah_sopir = Sopir::all()->count();
        if ($jumlah_sopir === 0) {
            Sopir::create([
                'nik' => '-',
                'no_sim' => '-',
                'nama_sopir' => '-',
                'no_hp' => '-',
                'alamat' => '-',
                'tarif_perhari' => 0,
                'jenis_kelamin' => 'L',
                'status_sopir' => 'Luang'
            ]);
        }

        $sopir = Sopir::where('id', '!=', 1)->get();
        return view('admin.sopir', compact('sopir'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'no_sim' => 'required',
            'nama_sopir' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tarif_perhari' => 'required',
            'jenis_kelamin' => 'required',
        ]);
        Sopir::create([
            'nik' => $request->nik,
            'no_sim' => $request->no_sim,
            'nama_sopir' => $request->nama_sopir,
            'no_hp' => preg_replace('/\D/', '', $request->no_hp),
            'alamat' => $request->alamat,
            'tarif_perhari' => preg_replace('/\D/', '', $request->tarif_perhari),
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_sopir' => 'Luang'
        ]);
        return redirect()->back()->with('alert', 'Data sopir berhasil ditambahkan!');
    }
    public function update(Request $request, Sopir $sopir)
    {
        $request->validate([
            'no_hp' => 'required',
            'alamat' => 'required',
            'tarif_perhari' => 'required',
        ]);
        Sopir::where('id', $sopir->id)->update([
            'no_hp' => preg_replace('/\D/', '', $request->no_hp),
            'alamat' => $request->alamat,
            'tarif_perhari' => preg_replace('/\D/', '', $request->tarif_perhari),
        ]);
        return redirect()->back()->with('alert', 'Data sopir berhasil diubah!');
    }
    public function destroy(Sopir $sopir)
    {
        Sopir::destroy('id', $sopir->id);
        return redirect()->back()->with('alert', 'Data sopir berhasil dihapus!');
    }
}
