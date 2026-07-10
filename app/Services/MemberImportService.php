<?php

namespace App\Services;

use App\Models\MemberProfile;

class MemberImportService
{
    public static function import(array $data): MemberProfile
    {
        return ImportService::save($data);
    }
}