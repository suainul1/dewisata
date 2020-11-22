<?php

namespace App\Http\Controllers;

use App\Models\GaleryWisata;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class WisataController extends Controller
{
    public function all()
    {
        $wisata = Wisata::paginate(10);
        return view('datawisata.data', compact('wisata'));
    }
    public function konfirmasi(Request $request, $act)
    {
        $w = Wisata::findOrfail($request->id);
        $t = '';
        $act == 'terima' ? $t = 'terima' : $t = 'tolak';
        $w->update([
            'status' => $t,
        ]);
        return redirect()->route('wisata.data');
    }
    public function pengajuan()
    {
        $w = auth()->user()->wisata()->first();
        return view('datawisata.daftar',compact('w'));
    }
    public function store(Request $request)
    {
        $file = $request->file('dokumen');
        $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
        $request->file('dokumen')->storeAs('public/dokumen', $fileName);
        
    $w =  auth()->user()->wisata()->update([
            'nama_wisata' => $request->nama_wisata,
            'alamat_wisata' => $request->alamat_wisata,
            'jenis_wisata' => $request->jenis_wisata,
            'jam_operasional' => $request->jam_wisata,
            'deskripsi_wisata' => $request->deskripsi_wisata,
            'dokumen_wisata' => $fileName,
            'slug' => Str::slug($request->nama_wisata, '-'),
            'status' => 'pengajuan',
            ]);
        foreach ($request->file('image') as $val) {        
        $fileName = substr(md5(microtime()), 0, 100) . '.' . $val->getClientOriginalExtension();
        $val->storeAs('public/gallery', $fileName);
        GaleryWisata::create([
                'wisata_id' => $w,
                'foto' => $fileName,
            ]);
    
        }
        return redirect()->back();
    }
}
