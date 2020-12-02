<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\TransaksiHarga;
use App\Models\Wisata;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtalaseController extends Controller
{
    public function __construct()
    {
        $this->xendit = new XenditController;
    }
    public function index()
    {
        $wisata = Wisata::where('status','terima')->get();
        return view('etalase.index',compact('wisata'));
    }
    public function show(Wisata $w)
    {
        return view('etalase.show',compact('w'));
    }
    public function setPrice(Wisata $w)
    {
        $tiket = Tiket::where('wisata_id',$w->id)->get();
        return view('etalase.checkout',compact(['tiket','w']));
    }
    public function checkout(Request $request,Wisata $w)
    {
        DB::transaction(function() use($request,$w){
            $trans = Transaksi::create([
                'user_id' => auth()->user()->id,
                'wisata_id' => $w->id,
                'kode' => Str::random(6),
                'nama_wisata' => $w->nama_wisata,
                'jumlah_orang' => $request->orang,
                'batas_pembayaran' => Carbon::now()->addHours(24),
                'status' => 'proses',
            ]);
            for ($i=0; $i < count($request->harga); $i++) {
                $hargaa = Tiket::findOrFail($request->harga[$i]); 
                TransaksiHarga::create([
                    'transaksi_id' => $trans->id,
                    'nama' => $hargaa->nama,
                    'harga' => $hargaa->harga,
                ]);
            }
            $invoice = $this->xendit->createInvoice($trans->id,'dewisata', auth()->user()->email, $w->deskripsi_wisata, TransaksiHarga::where('transaksi_id',$trans->id)->sum('harga') * $request->orang);
           
            $trans->update([
                'invoice_id' =>  $invoice['id'],
            ]);     
        });
        return redirect()->route('transaksi.riwayat');
    }
}
