<?php

namespace App\Http\Controllers;

use App\Merk;
use App\Tipe;
use App\ViewTipe;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    public function index()
    {
        $merk = Merk::all();
        $tipe = ViewTipe::all();
        return view('admin.tipe', compact('merk', 'tipe'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_merk' => 'required',
            'kode_tipe' => 'required',
            'nama_tipe' => 'required'
        ]);

        Tipe::create($request->all());
        return redirect()->back()->with('alert', 'Data tipe berhasil ditambahkan!');
    }
    public function update(Request $request, Tipe $tipe)
    {
        $request->validate([
            'nama_tipe' => 'required'
        ]);
        Tipe::where('id', $tipe->id)->update(['nama_tipe' => $request->nama_tipe]);
        return redirect()->back()->with('alert', 'Data tipe berhasil diubah!');
    }
    public function destroy(Tipe $tipe)
    {
        Tipe::destroy($tipe->id);
        return redirect()->back()->with('alert', 'Data tipe berhasil dihapus!');
    }
}
