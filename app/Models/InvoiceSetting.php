<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class InvoiceSetting extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'cai',
        'from_range',
        'to_range',
        'limit_date'
    ];

}
