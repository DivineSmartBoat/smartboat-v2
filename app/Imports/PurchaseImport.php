<?php

namespace App\Imports;

use App\Models\Purchase;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchaseImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Purchase([

            'invoice_no'        => $row['invoice_no'] ?? null,

            'smart_id'          => $row['smart_id'] ?? null,

            'full_name'         => $row['full_name'] ?? null,

            'mobile'            => $row['mobile'] ?? null,

            'product_name'      => $row['product_name'] ?? null,

            'purpose'           => $row['purpose'] ?? null,

            'qty'               => $row['qty'] ?? 1,

            'amount'            => preg_replace('/[^0-9.]/', '', $row['amount'] ?? 0),

            'purchase_datetime' => !empty($row['purchase_datetime'])
                ? Carbon::parse(trim($row['purchase_datetime']))->format('Y-m-d H:i:s')
                : null,

            'payment_status'    => $row['payment_status'] ?? null,

            'payment_method'    => $row['payment_method'] ?? null,

        ]);
    }
}