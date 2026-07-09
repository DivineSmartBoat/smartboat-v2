<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MemberProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $member = MemberProfile::where('email', $credentials['login'])
            ->orWhere('smart_id', $credentials['login'])
            ->first();

        if (! $member || ! Hash::check($credentials['password'], $member->password)) {
            return back()
                ->withErrors(['login' => 'Invalid Smart ID/email or password.'])
                ->onlyInput('login');
        }

        if (! $member->is_active) {
            return back()
                ->withErrors(['login' => 'Your account is inactive. Please contact support.'])
                ->onlyInput('login');
        }

        $request->session()->put('member_id', $member->id);
        $request->session()->regenerate();

        return redirect()->route('register')->with('status', 'Login successful.');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('member_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Logged out successfully.');
    }
}
