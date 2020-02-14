<?php

namespace App\Http\Controllers;

use App\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function index()
    {
        $merk = Merk::all();
        return view('admin.merk', compact('merk'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode_merk' => 'required',
            'nama_merk' => 'required'
        ]);
        Merk::create($request->all());
        return redirect()->back()->with('alert', 'Data merk berhasil ditambahkan!');
    }
    public function update(Request $request, Merk $merk)
    {
        $request->validate(['nama_merk' => 'required']);
        Merk::where('id', $merk->id)->update(['nama_merk' => $request->nama_merk]);
        return redirect()->back()->with('alert', 'Data merk berhasil diubah!');
    }
    public function destroy(Merk $merk)
    {
        Merk::destroy('id', $merk->id);
        return redirect()->back()->with('alert', 'Data merk berhasil dihapus!');
    }
}
