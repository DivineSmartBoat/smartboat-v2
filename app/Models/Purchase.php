<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';

    protected $fillable = [

        'invoice_no',

        'smart_id',

        'full_name',

        'mobile',

        'product_name',

        'purpose',

        'qty',

        'amount',

        'purchase_datetime',

        'payment_status',

        'payment_method',

    ];

    public $timestamps = false;
}
