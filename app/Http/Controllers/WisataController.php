<?php

namespace App\Http\Controllers;

use App\Models\GaleryWisata;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class WisataController extends Controller
{
    public function all()
    {
        $wisata = Wisata::paginate(10);
        return view('datawisata.data', compact('wisata'));
    }
    public function detail(Wisata $wisata)
    {
        return view('datawisata.daftar', compact('wisata'));

    }
    public function konfirmasi(Request $request, $act='tolak')
    {
        $w = Wisata::findOrfail($request->id);
        $w->update([
            'status' => $act,
            'pesan' => $request->pesan ?? 'Selamat Bergabung Dengan Kami '.$w->user->name,
        ]);
        return redirect()->route('wisata.data');
    }
    public function pengajuan()
    {
        $wisata = auth()->user()->wisata()->first();
        return view('datawisata.daftar', compact('wisata'));
    }
    public function kelola()
    {
        $bank = new XenditController;
        $bank = $bank->getBank();
        $wisata = auth()->user()->wisata()->first();
        return view('datawisata.kelola', compact(['bank','wisata']));
    }
    public function update(Request $request,Wisata $wisata)
    {
        if (!empty($request->file('image'))) {
            foreach ($request->file('image') as $val) {
                $fileName = substr(md5(microtime()), 0, 100) . '.' . $val->getClientOriginalExtension();
                $val->storeAs('public/gallery', $fileName);
                $wisata->gallery()->create([
                    'foto' => $fileName,
                ]);
            }
        }
        $wisata->update([
            'jenis_wisata' => $request->jenis_wisata ?? $wisata->jenis_wisata,
            'jam_operasional' => $request->jam_wisata ?? $wisata->jam_operasional,
            'deskripsi_wisata' => $request->deskripsi_wisata ?? $wisata->deskripsi_wisata,
        ]);
        return redirect()->back();
    }
    public function destroyFoto(GaleryWisata $gallery)
    {
        File::delete(storage_path('app/public/gallery/' . $gallery->foto));
        $gallery->delete();
        return redirect()->back();
    }
    public function ajukan(Request $request)
    {
        $wisata = auth()->user()->wisata()->first();

        if ($wisata->status != 'pengajuan') {
            if ($request->file('dokumen') && $wisata->status == 'tolak') {
                File::delete(storage_path('app/public/dokumen/' . $wisata->dokumen_wisata));
            }
            if ($wisata->status == 'proses' || $request->file('dokumen')) {
                $file = $request->file('dokumen');
                $fileName = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
                $request->file('dokumen')->storeAs('public/dokumen', $fileName);
            } else {
                $fileName = $wisata->dokumen_wisata;
            }
            if ($request->file('scan_ktp') && $wisata->status == 'tolak') {
                File::delete(storage_path('app/public/ktp/' . $wisata->scan_ktp));
                $file = $request->file('scan_ktp');
                $fileKtp = substr(md5(microtime()), 0, 100) . '.' . $file->getClientOriginalExtension();
                $request->file('scan_ktp')->storeAs('public/ktp', $fileKtp);
            }else {
                $fileKtp = $wisata->scan_ktp;
            }
            if ($wisata->status == 'tolak' && !empty($request->file('image'))) {
                foreach ($wisata->gallery as $v) {
                    File::delete(storage_path('app/public/gallery/' . $v->foto));
                    $v->delete();
                }
            }

            $wisata->update([
                'nama_wisata' => $request->nama_wisata,
                'alamat_wisata' => $request->alamat_wisata,
                'jenis_wisata' => $request->jenis_wisata,
                'jam_operasional' => $request->jam_wisata,
                'deskripsi_wisata' => $request->deskripsi_wisata,
                'dokumen_wisata' => $fileName,
                'nik' => $request->nik,
                'scan_ktp' => $fileKtp,
                'slug' => Str::slug($request->nama_wisata, '-'),
                'status' => 'pengajuan',
            ]);
            if ($wisata->status == 'proses' || !empty($request->file('image'))) {
                foreach ($request->file('image') as $val) {
                    $fileName = substr(md5(microtime()), 0, 100) . '.' . $val->getClientOriginalExtension();
                    $val->storeAs('public/gallery', $fileName);
                    $wisata->gallery()->create([
                        'foto' => $fileName,
                    ]);
                }
            }
        }
        return redirect()->back();
    }
}
