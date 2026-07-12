<?php

namespace App\Imports;

use App\Models\Purchase;
use App\Models\MemberProfile;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PurchaseImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $purchase = new Purchase([

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

        $purchase->save();

        $member = MemberProfile::where('smart_id', $purchase->smart_id)->first();

        if ($member) {

            if (
                empty($member->first_purchase_datetime)
                || $purchase->purchase_datetime < $member->first_purchase_datetime
            ) {
                $member->first_purchase_datetime = $purchase->purchase_datetime;
            }

            $member->last_purchase_datetime = Purchase::where('smart_id', $purchase->smart_id)
                ->max('purchase_datetime');

            $member->purchase_count = Purchase::where('smart_id', $purchase->smart_id)
                ->count();

            $member->total_purchase_amount = Purchase::where('smart_id', $purchase->smart_id)
                ->sum('amount');

            $member->save();
        }

        return null;
    }
}