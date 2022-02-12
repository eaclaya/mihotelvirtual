<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use App\Models\User;
use App\Repositories\InvoiceSettingRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;

class InvoiceSettingController extends Controller
{
    private $invoiceSettingRepository;

    public function __construct(InvoiceSettingRepository $invoiceSettingRepository)
    {
        $this->invoiceSettingRepository = $invoiceSettingRepository;
    }

    public function index(Request $request)
    {
        $invoice = $this->invoiceSettingRepository->find($request);
        return view('setting.invoice', compact('invoice'));
    }

    public function create()
    {
        return view('setting.invoice');
    }

    public function store(Request $request)
    {
        $invoiceSetting = $this->invoiceSettingRepository->store($request);
        return redirect('invoice')->with('success', 'Datos de facturacion creados');
    }

    public function update(Request $request)
    {
        $invoiceSetting = $this->invoiceSettingRepository->store($request);
        return redirect('invoice')->with('success', 'Datos de facturacion actualizados');
    }
    
}
