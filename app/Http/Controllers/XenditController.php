<?php

namespace App\Http\Controllers;

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
    public function createInvoice($exid,$email,$desc,$harga)
    {
        $this->keyXendit;
        $params = [
            'external_id' => $exid,
            'payer_email' => $email,
            'description' => $desc,
            'amount' => $harga,
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        dd($createInvoice);
    }
    public function getBank()
    {
        $this->keyXendit;
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();
        return $getVABanks;
    }
    public function payout($exid,$jumlah,$code,$name,$no,$desc)
    {
        $this->keyXendit;
        $params = [
            'external_id' => 'dewisata-'.$exid,
            'amount' => $jumlah,
            'bank_code' => $code,
            'account_holder_name' => $name,
            'account_number' => $no,
            'description' => $desc,
        ];

        $createDisbursements = \Xendit\Disbursements::create($params);
        var_dump($createDisbursements);
    }
}
