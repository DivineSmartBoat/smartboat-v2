<?php

namespace App\Services;

class StatusService
{
    /**
     * Excel Status → Active / Inactive
     */
    public static function isActive(?string $status): bool
    {
        if (!$status) {
            return false;
        }

        $status = strtolower(trim($status));

        return in_array($status, [
            'active',
            'yes',
            'paid',
            '1'
        ]);
    }
}