<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function riwayat()
    {
        if (auth()->user()->role == 'wisatawan') {
            $transaksi = Transaksi::where('user_id', auth()->user()->id)->simplePaginate(10);
        } elseif (auth()->user()->role == 'pengelola_wisata') {
            $transaksi = Transaksi::whereHas('wisata', function ($q) {
                return $q->where('user_id', auth()->user()->id);
            })->simplePaginate(10);
        } else {
            $transaksi = Transaksi::simplePaginate(10);
        }
       

        return view('transaksi.riwayat', compact('transaksi'));
    }
    public function search(Request $request)
    {
        if (auth()->user()->role == 'pengelola_wisata') {
            $transaksi = Transaksi::whereHas('wisata', function ($q) {
                return $q->where('user_id', auth()->user()->id);
            })->where('kode', 'like', '%' . $request->search . '%')->simplePaginate(10);
        } elseif (auth()->user()->role == 'wisatawan') {
            $transaksi = Transaksi::where('user_id', auth()->user()->id)->where('kode', 'like', '%' . $request->search . '%')->orWhere('nama_wisata', 'like', '%' . $request->search . '%')->simplePaginate(10);
        } else {
            $transaksi = Transaksi::simplePaginate(10);
        }
        return view('transaksi.riwayat', compact('transaksi'));
    }
    public function berkunjung(Transaksi $transaksi)
    {
        $transaksi->update([
            'status' => 'berkunjung',
        ]);
        return redirect()->back();
    }
}
