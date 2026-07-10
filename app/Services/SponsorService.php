<?php

namespace App\Services;

use App\Models\MemberProfile;

class SponsorService
{
    /**
     * Find Sponsor by Smart ID
     */
    public static function findBySmartId(?string $smartId): ?MemberProfile
    {
        if (empty($smartId)) {
            return null;
        }

        return MemberProfile::where('smart_id', trim($smartId))->first();
    }

    /**
     * Get Database ID from Smart ID
     */
    public static function getIdFromSmartId(?string $smartId): ?int
    {
        $member = self::findBySmartId($smartId);

        return $member?->id;
    }

    /**
     * Check Sponsor Exists
     */
    public static function exists(?string $smartId): bool
    {
        return self::findBySmartId($smartId) !== null;
    }
}