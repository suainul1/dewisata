<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Wisata;
use Illuminate\Http\Request;

class HargaWisataController extends Controller
{
    public function create(Request $request,Wisata $wisata)
    {
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
