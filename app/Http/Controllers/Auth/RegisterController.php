<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberProfile;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        return "Registration Module Coming Soon";
    }

    public function sponsorSearch(Request $request)
    {
        $keyword = $request->keyword;

        $members = MemberProfile::where('smart_id', 'like', "%{$keyword}%")
            ->orWhere('full_name', 'like', "%{$keyword}%")
            ->limit(10)
            ->get([
                'smart_id',
                'full_name',
                'mobile',
                'email'
            ]);

        return response()->json($members);
    }
}