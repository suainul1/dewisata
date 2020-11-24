<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function riwayat()
    {
        $transaksi = Transaksi::where('wisata_id',auth()->user()->wisata->id)->get();
        return view('transaksi.riwayat',compact('transaksi'));
    }
}
