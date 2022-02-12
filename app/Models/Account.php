<?php

namespace App\Models;
use App\Models\InvoiceSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Account extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'vat_number',
        'invoice_prefix',
        'invoice_counter',
        'email',
        'logo'
    ];


    public function invoiceSetting(){
        return InvoiceSetting::orderBy('id', 'DESC')->first();
    }

}
