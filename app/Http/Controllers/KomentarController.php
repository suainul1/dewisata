<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\KomentarBalasan;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KomentarController extends Controller
{
    public function validasiKomen($request)
    {
        $validator = Validator::make($request->all(),[
            'isi' => ['required','string']
        ]);
        return $validator;
    }
    public function validasiBalas($request)
    {
        $validator = Validator::make($request->all(),[
            'balas' => ['required','string']
        ]);
        return $validator;
    }
    public function show($id)
    {
        $komentar = Komentar::where('wisata_id',$id)->with('balasan')->with('user')->get()->sortDesc();
        return $komentar;
        
    }
    public function create(Request $request,$id)
    {
        $validator = $this->validasiKomen($request);
        if ($validator->fails()) {
            foreach($validator->messages()->messages() as $er){
                toastr()->error($er[0],'Gagal Menyimpan');
              }
               return redirect()
                ->back();
		}
        Komentar::create([
            'wisata_id' => $id,
            'user_id' => auth()->user()->id,
            'isi' => $request->isi
        ]);
        return redirect()->back();
    }
    public function editKomen(Request $request,Komentar $id)
    {
        $validator = $this->validasiKomen($request);
        if ($validator->fails()) {
            foreach($validator->messages()->messages() as $er){
                toastr()->error($er[0],'Gagal Menyimpan');
              }
               return redirect()
                ->back();
		}
        $id->update([
            'isi' => $request->isi
        ]);
        return redirect()->back();
    }
    public function balas(Request $request, Komentar $k)
    {
        $validator = $this->validasiBalas($request);
        if ($validator->fails()) {
            foreach($validator->messages()->messages() as $er){
                toastr()->error($er[0],'Gagal Menyimpan');
              }
               return redirect()
                ->back();
		}
        $k->balasan()->create([
            'user_id' => auth()->user()->id,
            'isi' => $request->balas,
        ]);
            return redirect()->back();
    }
    public function editBalas(Request $request, KomentarBalasan $id)
    {
        $validator = $this->validasiBalas($request);
        if ($validator->fails()) {
            foreach($validator->messages()->messages() as $er){
                toastr()->error($er[0],'Gagal Menyimpan');
              }
               return redirect()
                ->back();
		}
        $id->update([
            'isi' => $request->balas,
        ]);
            return redirect()->back();
    }
  
}
