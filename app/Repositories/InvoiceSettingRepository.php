<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\InvoiceSetting;
use Illuminate\Support\Str;

class InvoiceSettingRepository
{
   public function find($request){
        $invoiceSettingId = $request->invoice_setting_id ? $request->invoice_setting_id : 1;
        $invoiceSetting = InvoiceSetting::find($invoiceSettingId);
        if(!$invoiceSetting){
            $invoiceSetting = new InvoiceSetting();
        }
        return $invoiceSetting;
   }

   public function store($request){
        $accountId = $request->account_id ? $request->account_id : 1;
        $invoiceSettingId = $request->invoice_setting_id ? $request->invoice_setting_id : 1;
        $setting = new InvoiceSetting();
        $setting->cai = $request->cai;
        $setting->from_range = $request->from_range;
        $setting->to_range = $request->to_range;
        $setting->limit_date = $request->limit_date;
        $setting->account_id = $accountId;
        $setting->save();
        $account = Account::find($accountId);
        if($account){
            $account->invoice_setting_id = $setting->id;
            $array = explode("-", $setting->from_range);
            $invoiceNumber = intval($array[count($array) - 1]);
            $account->invoice_counter = $invoiceNumber;
            $account->invoice_prefix = substr($setting->from_range, 0, strrpos($setting->from_range, '-') + 1);
            $account->save();    
        }
        
        return $account;
   }
}
