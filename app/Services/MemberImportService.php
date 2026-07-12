<?php

namespace App\Services;

use App\Models\MemberProfile;
use Exception;

class MemberImportService
{
    /**
     * Import Member
     */
    public static function import(array $data): MemberProfile
    {
        /*
        |--------------------------------------------------------------------------
        | Skip Test Data
        |--------------------------------------------------------------------------
        */

        if (!empty($data['is_test_data']) && $data['is_test_data'] === true) {
            throw new Exception('Test Data Cannot Be Imported Into Production.');
        }

        return ImportService::save($data);
    }
}