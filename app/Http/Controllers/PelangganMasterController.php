<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelangganMasterController extends Controller
{
    public function index()
    {
        return view('pelanggan.dashboard');
    }
    public function profile()
    {
        return view('pelanggan.profile');
    }
}
