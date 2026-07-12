<?php

namespace App\Services;

use App\Models\MemberProfile;

class SmartIdService
{
    private const MEMBER_PREFIX = 'SB2407';
    /**
     * Generate the next Smart ID.
     *
 * Format:
 * SB2407 + Running Number
 * Example:
 * SB2407000001
     */
    public static function generate(): string
    {
        

$prefix = self::MEMBER_PREFIX;

$lastMember = MemberProfile::where('smart_id', 'like', 'SB%')
    ->orderByDesc('id')
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