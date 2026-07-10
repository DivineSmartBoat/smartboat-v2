<?php

namespace App\Services;

use App\Models\MemberProfile;

class LoginService
{
    public static function findByLogin(string $login): ?MemberProfile
    {
        return MemberProfile::where('smart_id', $login)
            ->orWhere('email', $login)
            ->orWhere('mobile', $login)
            ->first();
    }
}