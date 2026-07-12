<?php

namespace App\Services;

use App\Models\MemberProfile;

class SponsorService
{
    /**
     * Permanent Admin Smart ID
     */
    private const DEFAULT_ADMIN_SMART_ID = 'ADMIN0001';

    /**
     * Find Sponsor by Smart ID
     */
    public static function findBySmartId(?string $smartId): ?MemberProfile
    {
        if (empty($smartId)) {
            return null;
        }

        return MemberProfile::where(
            'smart_id',
            trim($smartId)
        )->first();
    }

    /**
     * Default Admin Sponsor
     */
    public static function getDefaultSponsor(): ?MemberProfile
    {
        return self::findBySmartId(
            self::DEFAULT_ADMIN_SMART_ID
        );
    }

    /**
     * Resolve Sponsor
     */
    public static function resolve(
        string $sponsorType,
        ?string $smartId
    ): ?MemberProfile {

        if ($sponsorType === 'with_sponsor') {
            return self::findBySmartId($smartId);
        }

        return self::getDefaultSponsor();
    }

    /**
     * Get Database ID
     */
    public static function getIdFromSmartId(
        ?string $smartId
    ): ?int {

        return self::findBySmartId($smartId)?->id;
    }

    /**
     * Sponsor Exists
     */
    public static function exists(
        ?string $smartId
    ): bool {

        return self::findBySmartId($smartId) !== null;
    }
}