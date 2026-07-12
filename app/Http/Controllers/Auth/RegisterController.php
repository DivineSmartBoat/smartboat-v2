<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MemberProfile;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected RegistrationService $registrationService;

    public function __construct()
    {
        $this->registrationService = new RegistrationService();
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sponsor_type' => ['required', 'in:with_sponsor,without_sponsor'],
            'sponsor_smart_id' => [
                'nullable',
                'required_if:sponsor_type,with_sponsor',
                'exists:member_profiles,smart_id',
            ],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:member_profiles,email'],
            'country_code' => ['required', 'string', 'max:10'],
            'mobile' => ['required', 'string', 'max:25'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'terms' => ['accepted'],
        ]);

$result = $this->registrationService->register($validated);

$member = $result['member'];

$request->session()->regenerate();

return redirect()
    ->route('register.success')
    ->with([

        'member_id' => $member->id,

        'smart_id' => $member->smart_id,

        'login_password'
            => $result['plain_login_password'],

        'transaction_password'
            => $result['plain_transaction_password'],

        'real_sponsor_name'
            => optional($member->realSponsor)->full_name
                ?? 'Admin',

        'real_sponsor_smart_id'
            => optional($member->realSponsor)->smart_id
                ?? 'ADMIN',

        'rising_sponsor_name'
            => optional($member->risingSponsor)->full_name
                ?? '-',

        'rising_sponsor_smart_id'
            => optional($member->risingSponsor)->smart_id
                ?? '-',

    ]);
    }

    public function sponsorSearch(Request $request)
    {
        $keyword = trim((string) $request->query('keyword', ''));

        if (strlen($keyword) < 2) {
            return response()->json([]);
        }

        $members = MemberProfile::where('smart_id', 'like', "%{$keyword}%")
            ->orWhere('full_name', 'like', "%{$keyword}%")
            ->limit(10)
            ->get([
                'smart_id',
                'full_name',
                'mobile',
                'email',
            ]);

        return response()->json($members);
    }
}