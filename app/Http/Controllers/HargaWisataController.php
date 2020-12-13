<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HargaWisataController extends Controller
{
    public function validasi($request)
    {
        $validator = Validator::make($request->all(),[
            'harga'    => ['required','array','min:1'],
            'harga.*'    => ['required'],
        ]);
        return $validator;
    }
    public function create(Request $request,Wisata $wisata)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) {
            foreach($validator->messages()->messages() as $er){
                toastr()->error($er[0],'Gagal Menyimpan');
              }
               return redirect()
                ->back();
		}
        if($wisata->tiket()->exists() && !empty($request->harga)){
            $wisata->tiket()->delete();
        }
        if(!empty($request->harga)){
            for ($i=0; $i < count($request->harga); $i++) { 
                $wisata->tiket()->create([
                    'nama' => $request->nama[$i],
                    'harga' => $request->harga[$i]
                ]);
            }
        }
        return redirect()->back();
    }
    public function destroy(Tiket $tiket)
    {
        $tiket->delete();
        return redirect()->back();
    }
}
