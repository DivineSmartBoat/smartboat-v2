<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberProfile;
use App\Models\Purchase;
use Illuminate\Http\Request;

class ITCController extends Controller
{
    /**
     * ITC List
     */
    public function index(Request $request)
{
    $query = MemberProfile::query();

    if ($request->filled('smart_id')) {
        $query->where('smart_id', 'like', '%' . $request->smart_id . '%');
    }

    if ($request->filled('name')) {
        $query->where('full_name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('mobile')) {
        $query->where('mobile', 'like', '%' . $request->mobile . '%');
    }

    $itcs = $query
    ->select('member_profiles.*')
    ->orderByDesc('registration_datetime')
    ->paginate(25)
    ->withQueryString();
 

    return view('admin.itc.index', compact('itcs'));
}

    /**
     * ITC Profile
     */
    public function show(string $smart_id)
    {
        $itc = MemberProfile::where(
            'smart_id',
            $smart_id
        )->firstOrFail();

$purchases = Purchase::where('smart_id', $smart_id)
    ->latest('purchase_datetime')
    ->get();

        return view(
            'admin.itc.show',
            compact(
                'itc',
                'purchases'
            )
        );
    }
}