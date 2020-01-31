<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanMasterController extends Controller
{
    public function index()
    {
        return view('karyawan.dashboard');
    }
    public function profile()
    {
        return view('karyawan.profile');
    }
}
