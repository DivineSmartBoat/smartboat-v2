<?php

namespace App\Services;

use App\Models\MemberProfile;

class TeamService
{
    public static function getDirectMembers(int $memberId)
    {
        return MemberProfile::where('real_sponsor_id', $memberId)->get();
    }

    public static function getDirectCount(int $memberId): int
    {
        return MemberProfile::where('real_sponsor_id', $memberId)->count();
    }
}