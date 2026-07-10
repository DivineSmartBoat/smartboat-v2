<?php

namespace App\Services;

use App\Models\MemberProfile;

class SmartIdService
{
    /**
     * Generate the next Smart ID.
     *
     * Format:
     * SB + YYMM + 6 Digit Running Number
     * Example:
     * SB2607000001
     */
    public static function generate(): string
    {
        $prefix = 'SB' . now()->format('ym');

        $lastMember = MemberProfile::where('smart_id', 'like', $prefix . '%')
            ->orderByDesc('smart_id')
            ->first();

        if (!$lastMember) {
            $next = 1;
        } else {
            $lastNumber = (int) substr($lastMember->smart_id, -6);
            $next = $lastNumber + 1;
        }

        return $prefix . str_pad($next, 6, '0', STR_PAD_LEFT);
    }
}