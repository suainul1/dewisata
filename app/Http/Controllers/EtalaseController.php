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
use Illuminate\Support\Facades\Validator;

class EtalaseController extends Controller
{
    public function __construct()
    {
        $this->xendit = new XenditController;
    }
    public function validasi($request)
    {
        $validator = Validator::make($request->all(),[
            'berkunjung' => ['required'],
            'harga' => ['required'],
        ]);
        return $validator;
    }
    public function index()
    {
        
        $wisata = Wisata::where('status','terima')->get();
        return view('etalase.index',compact('wisata'));
    }
    public function show(Wisata $w)
    {
        $komentar = new KomentarController;
        $komentar = $komentar->show($w->id);
        return view('etalase.show',compact(['w','komentar']));
    }
    public function setPrice(Wisata $w)
    {
        $tiket = Tiket::where('wisata_id',$w->id)->get();
        return view('etalase.checkout',compact(['tiket','w']));
    }
    public function checkout(Request $request,Wisata $w)
    {
        $hitung = TransaksiHarga::whereHas('transaksi',function($q) use($w,$request){
            $q->where([['wisata_id',$w->id],['tanggal_berkunjung', $request->berkunjung],['status','!=','terbayar']]);
        })->where('nama','harga_masuk')->sum('jumlah');
        if($hitung+$request->orang[0] >= $w->kapasitas){
            return redirect()->back()->with('error', 'Kuota Pada hari tersebut telah tercukupi');
        }elseif($request->berkunjung < Carbon::now()){
             return redirect()->back()->with('error', 'tanggal telah terlewat');
        }
        $validator = $this->validasi($request);
        if ($validator->fails()) {
            foreach($validator->messages()->messages() as $er){
                toastr()->error($er[0],'Gagal Menyimpan');
              }
               return redirect()
                ->back();
		}
        DB::transaction(function() use($request,$w){
            $trans = Transaksi::create([
                'user_id' => auth()->user()->id,
                'wisata_id' => $w->id,
                'kode' => Str::random(6),
                'nama_wisata' => $w->nama_wisata,
                'tanggal_berkunjung' => $request->berkunjung,
                'batas_pembayaran' => Carbon::now()->addHours(24),
                'status' => 'proses',
            ]);
            $total=0;
            for ($i=0; $i < count($request->harga); $i++) {
                $hargaa = Tiket::findOrFail($request->harga[$i]); 
                $jumlah = $request->orang[$i];
                $total += ($hargaa->harga * $jumlah);
                TransaksiHarga::create([
                    'transaksi_id' => $trans->id,
                    'nama' => $hargaa->nama,
                    'jumlah' => $jumlah,
                    'harga' => $hargaa->harga,
                ]);
            }
            $invoice = $this->xendit->createInvoice($trans->id,'dewisata', auth()->user()->email, $w->deskripsi_wisata, $total);
           
            $trans->update([
                'invoice_id' =>  $invoice['id'],
                'harga_total' => $total,
            ]);     
        });
        return redirect()->route('transaksi.riwayat');
    }
}
