<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MemberProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sponsor_type' => ['required', 'in:with_sponsor,without_sponsor'],
            'sponsor_smart_id' => ['nullable', 'required_if:sponsor_type,with_sponsor', 'exists:member_profiles,smart_id'],
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:member_profiles,email'],
            'country_code' => ['required', 'string', 'max:10'],
            'mobile' => ['required', 'string', 'max:25'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'transaction_password' => ['required', 'string', 'min:4', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        $member = DB::transaction(function () use ($validated) {
            $sponsor = null;

            if ($validated['sponsor_type'] === 'with_sponsor') {
                $sponsor = MemberProfile::where('smart_id', $validated['sponsor_smart_id'])->firstOrFail();
            }

            return MemberProfile::create([
                'smart_id' => $this->nextSmartId(),
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'country_code' => $validated['country_code'],
                'mobile' => $validated['mobile'],
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'gender' => $validated['gender'],
                'real_sponsor_id' => $sponsor?->id,
                'rising_sponsor_id' => $sponsor?->id,
                'real_sponsor_smart_id' => $sponsor?->smart_id,
                'rising_sponsor_smart_id' => $sponsor?->smart_id,
                'password' => $validated['password'],
                'transaction_password' => $validated['transaction_password'],
                'terms' => true,
                'is_active' => true,
                'registration_datetime' => now(),
            ]);
        });

        $request->session()->put('member_id', $member->id);
        $request->session()->regenerate();

        return redirect()
            ->route('register')
            ->with('status', "Registration complete. Your Smart ID is {$member->smart_id}.");
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

    private function nextSmartId(): string
    {
        $latestId = MemberProfile::lockForUpdate()->max('id') ?? 0;

        return 'SB'.str_pad((string) ($latestId + 1), 6, '0', STR_PAD_LEFT);
    }
}
