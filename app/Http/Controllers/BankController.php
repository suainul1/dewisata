<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\PencairanDana;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function __construct(){
        $this->xendit = new XenditController; 
    }
    public function validasi($request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => ['required', 'string', 'max:25', 'min:2'],
            'no_rekening' => ['required', 'string', 'max:25'],
            'bank' => ['required', 'string', 'max:25','min:2'],
        ]);
        return $validator;
    }
    public function create(Request $request)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) {
          foreach($validator->messages()->messages() as $er){
            toastr()->error($er[0],'Gagal Menyimpan');
          }
           return redirect()
            ->back();
		}
        Bank::create([
            'user_id' => auth()->user()->id,
            'nama' => $request->nama,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank,
        ]);
        return redirect()->back();
    }
    public function update(Request $request,Bank $bank)
    {
        $validator = $this->validasi($request);
        if ($validator->fails()) {
           return redirect()
            ->back()
            ->withErrors($validator); 
		}
        $bank->update([
            'user_id' => auth()->user()->id,
            'nama' => $request->nama,
            'no_rekening' => $request->no_rekening,
            'bank' => $request->bank,
        ]);
        return redirect()->back();
    }
    public function pencairan(Request $request)
    {
        try{
        DB::transaction(function () use($request){
            $p = PencairanDana::create([
                'user_id' => auth()->user()->id,
                'jumlah' => $request->jumlah,
                'keterangan' => 'pencairan uang tiket milik '.auth()->user()->name,
                ]);
            $this->xendit->payout($p->id,$p->jumlah,$p->user->bank->bank,$p->user->bank->nama,$p->user->bank->no_rekening,$p->keterangan);
            });
        } catch (Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
            return redirect()->back();
    }
}
