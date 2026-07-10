<?php

namespace App\Services;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelDateService
{
    /**
     * Convert Excel DateTime to MySQL format.
     */
    public static function convert($value): ?string
    {
        if (empty($value)) {
            return null;
        }

        try {

            if (is_numeric($value)) {
                return Date::excelToDateTimeObject($value)
                    ->format('Y-m-d H:i:s');
            }

            return Carbon::parse($value)
                ->format('Y-m-d H:i:s');

        } catch (\Throwable $e) {

            return null;

        }
    }
}