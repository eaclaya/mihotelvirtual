<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Models\InvoiceSetting;

class PaymentRepository
{
    public function store($request, $transaction, string $status)
    {
        if(!empty($request->downPayment)){
            $price = $request->downPayment;
        } else {
            $price = $request->payment;
        }
        $payment = Payment::create([
            'user_id' => Auth()->user()->id,
            'transaction_id' => $transaction->id,
            'price' => $price,
            'status' => $status
        ]);
        $transaction->balance -= $payment->price;
        if($transaction->balance == 0){
            $transaction = $this->setNextInvoiceNumber($transaction);
            $transaction->invoice_date = date('Y-m-d');
        }
        $transaction->save();
        return $payment;
    }

    public function setNextInvoiceNumber($transaction){
        $invoiceNumber = str_pad(Auth()->user()->account->invoice_counter ,8, '0', STR_PAD_LEFT);
        if(Auth()->user()->account->invoice_prefix && Auth()->user()->account->invoice_counter){
            $invoiceNumber = Auth()->user()->account->invoice_prefix.str_pad(Auth()->user()->account->invoice_counter ,8, '0', STR_PAD_LEFT);
        }
        $invoiceSetting = $transaction->getInvoiceSetting();
        $transaction->invoice_number = $invoiceNumber;
        $transaction->invoice_setting_id = $invoiceSetting ? $invoiceSetting->id : null;
        auth()->user()->account->invoice_counter += 1;
        auth()->user()->account->save();
        return $transaction;
    }
}
