<?php

namespace App\Services;

class InvoiceService
{
    public static function generateInvoiceNumber(): string
    {
        return 'INV' . now()->format('YmdHis');
    }
}