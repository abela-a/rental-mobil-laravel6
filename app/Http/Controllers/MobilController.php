<?php

namespace App\Http\Controllers;

use App\Merk;
use App\Mobil;
use App\Tipe;
use App\ViewMobil;
use App\ViewTipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MobilController extends Controller
{
    protected $path = 'img/fotomobil';

    public function index()
    {
        $mobil = ViewMobil::all();
        $merk = Merk::all();
        return view('admin.mobil', compact('mobil', 'merk'));
    }
    public function getTipe($tipe)
    {
        $tipe = ViewTipe::where('kode_merk', $tipe)->get();
        return view('admin.addons.getTipe', compact('tipe'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'no_plat' => 'required',
            'kode_merk' => 'required',
            'kode_tipe' => 'required',
            'jenis_mobil' => 'required',
            'transmisi' => 'required',
            'harga_sewa' => 'required',
            'foto_mobil' => 'required|file|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        $file = $request->file('foto_mobil');
        $foto_mobil = 'fotomobil-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($this->path, $foto_mobil);

        Mobil::create([
            'no_plat' => $request->no_plat,
            'kode_merk' => $request->kode_merk,
            'kode_tipe' => $request->kode_tipe,
            'jenis_mobil' => $request->jenis_mobil,
            'transmisi' => $request->transmisi,
            'harga_sewa' => preg_replace('/\D/', '', $request->harga_sewa),
            'foto_mobil' => $foto_mobil,
            'status_rental' => 'Kosong'
        ]);
        return redirect()->back()->with('alert', 'Data mobil berhasil ditambahkan!');
    }
    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'harga_sewa' => 'required',
            'foto_mobil' => 'file|image|mimes:jpg,jpeg,png|max:1000',
        ]);

        if ($request->foto_mobil == null) {
            $foto_mobil = $mobil->foto_mobil;
        } else {
            File::delete($this->path . '/' . $mobil->foto_mobil);
            $file = $request->file('foto_mobil');
            $foto_mobil = 'fotomobil-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($this->path, $foto_mobil);
        }

        Mobil::where('id', $mobil->id)->update([
            'harga_sewa' => preg_replace('/\D/', '', $request->harga_sewa),
            'foto_mobil' => $foto_mobil
        ]);
        return redirect()->back()->with('alert', 'Data mobil berhasil diubah!');
    }
    public function destroy(Mobil $mobil)
    {
        Mobil::destroy('id', $mobil->id);
        File::delete($this->path . '/' . $mobil->foto_mobil);
        return redirect()->back()->with('alert', 'Data mobil berhasil dihapus!');
    }
}
