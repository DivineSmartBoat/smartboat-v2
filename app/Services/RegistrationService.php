<?php

namespace App\Services;

use App\Models\MemberProfile;
use Illuminate\Support\Facades\DB;
use App\Services\SmartIdService;
use App\Services\PasswordService;
use App\Services\SponsorService;

class RegistrationService
{
    protected SmartIdService $smartIdService;
    protected PasswordService $passwordService;
    protected SponsorService $sponsorService;
    public function __construct()
    {
    $this->smartIdService = new SmartIdService();
    $this->passwordService = new PasswordService();
    $this->sponsorService = new SponsorService();
}    )
public function register(array $data): MemberProfile
{
            $smartId = $this->smartIdService->generate();

            $loginPassword = $this->passwordService->generatePassword(
                $data['full_name'],
                $data['mobile']
            );

            $transactionPassword = $this->passwordService->generateTransactionPassword(
                $data['full_name'],
                $data['mobile']
            );
       $sponsorId = $sponsor?->id;

return MemberProfile::create([
    'smart_id' => $smartId,
    'full_name' => $data['full_name'],
    'email' => $data['email'],
    'country_code' => $data['country_code'],
    'mobile' => $data['mobile'],
    'date_of_birth' => $data['date_of_birth'] ?? null,
    'gender' => $data['gender'],

    'real_sponsor_id' => $sponsorId,
    'rising_sponsor_id' => $sponsorId,
    'real_sponsor_smart_id' => $sponsor?->smart_id,
    'rising_sponsor_smart_id' => $sponsor?->smart_id,

    'password' => $loginPassword,
    'transaction_password' => $transactionPassword,

    'terms' => true,
    'is_active' => true,
    'registration_datetime' => now(),
        ]);
    });
}
}