<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{
    public function __construct()
    {
        $this->keyXendit = Xendit::setApiKey('xnd_development_8Q3LOf1ApYpdcGNVQCUBbAyx71ho76ESN9qx16ctKwk0MG0Y9DeJ0TDyML4Pra');
    }
    public function getBalance()
    {
        $this->keyXendit;
        $getBalance = \Xendit\Balance::getBalance('CASH');
        return $getBalance['balance'];
    }
    public function createInvoice($id,$kode,$email,$desc,$price)
	{
		$this->keyXendit;
		$params = [
			'external_id' => $id.'_'.$kode,
			'payer_email' => $email,
			'description' => $desc,
			'amount' => $price,
		];

		$createInvoice = \Xendit\Invoice::create($params);
		return $createInvoice;
	}
    public function getBank()
    {
        $this->keyXendit;
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return $getVABanks;
    }
    public function payout()
    {
        dd(Transaksi::where('batas_pembayaran' ,'<=' ,Carbon::now()->toDateString())->where('status','proses')->update([
            'status' => 'batal'
        ]));

        $this->keyXendit;
        $x = \Xendit\Invoice::retrieve('5fc7b743e5e4f1409ecd35ef');
        $x = \Xendit\Invoice::expireInvoice('5fc7afb6e5e4f1409ecd35d1');
        return $x;
        // $this->keyXendit;
        // $params = [
        //     'external_id' => 'dewisata-'.$exid,
        //     'amount' => $jumlah,
        //     'bank_code' => $code,
        //     'account_holder_name' => $name,
        //     'account_number' => $no,
        //     'description' => $desc,
        // ];

        // $createDisbursements = \Xendit\Disbursements::create($params);
        // var_dump($createDisbursements);
    }
    public function expinvoice($x = '')
    {
        $this->keyXendit;
        $x = \Xendit\Invoice::expireInvoice($x);
        return $x;
    }
    public function invoice($x ='')
    {
        $this->keyXendit;
        $x = \Xendit\Invoice::retrieve($x);
        return $x;
    }
}
