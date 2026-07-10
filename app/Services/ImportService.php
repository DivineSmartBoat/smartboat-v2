<?php

namespace App\Services;

use App\Models\MemberProfile;

class ImportService
{
    /**
     * Save or Update Member Profile
     */
    public static function save(array $data): MemberProfile
    {
        return MemberProfile::updateOrCreate(

            [
                'smart_id' => $data['smart_id'],
            ],

            $data

        );
    }

    /**
     * Check Existing Member
     */
    public static function exists(string $smartId): bool
    {
        return MemberProfile::where('smart_id', $smartId)->exists();
    }

    /**
     * Find Member
     */
    public static function find(string $smartId): ?MemberProfile
    {
        return MemberProfile::where('smart_id', $smartId)->first();
    }

    /**
     * Count Imported Members
     */
    public static function count(): int
    {
        return MemberProfile::count();
    }
}