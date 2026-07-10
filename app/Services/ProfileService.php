<?php

namespace App\Services;

use App\Models\MemberProfile;

class ProfileService
{
    public static function findBySmartId(string $smartId): ?MemberProfile
    {
        return MemberProfile::where('smart_id', $smartId)->first();
    }

    public static function updateProfile(MemberProfile $member, array $data): bool
    {
        return $member->update($data);
    }
}