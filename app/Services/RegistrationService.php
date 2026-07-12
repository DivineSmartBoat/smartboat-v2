<?php

namespace App\Services;

use App\Models\MemberProfile;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function register(array $data): array
    {
        return DB::transaction(function () use ($data) {

 $sponsor = SponsorService::resolve(
    $data['sponsor_type'] ?? 'without_sponsor',
    $data['sponsor_smart_id'] ?? null
);

            $smartId = SmartIdService::generate();

            $loginPassword = PasswordService::generatePassword(
                $data['full_name'],
                $data['mobile']
            );

            $transactionPassword =
                PasswordService::generateTransactionPassword(
                    $data['full_name'],
                    $data['mobile']
                );

 $temporaryRisingSponsor = MemberProfile::orderBy(
    'registration_datetime',
    'desc'
)->first();

$member = MemberProfile::create([
    'smart_id' => $smartId,

    'full_name' => $data['full_name'],

    'email' => $data['email'],

    'country_code' => $data['country_code'],

    'mobile' => $data['mobile'],

    'date_of_birth' => $data['date_of_birth'] ?? null,

    'gender' => $data['gender'] ?? null,

    'real_sponsor_id' => optional($sponsor)->id,

    'real_sponsor_smart_id' => optional($sponsor)->smart_id,

    // Temporary Rising Traffic (Registration Stage)
    'rising_sponsor_id' => optional($temporaryRisingSponsor)->id,

    'rising_sponsor_smart_id' => optional($temporaryRisingSponsor)->smart_id,

    'password' => $loginPassword,

    'transaction_password' => $transactionPassword,

    'terms' => true,

    'is_active' => true,

    'registration_datetime' => now(),
]);

            return [

                'member' => $member,

                'plain_login_password' => $loginPassword,

                'plain_transaction_password' => $transactionPassword,

            ];
        });
    }
}