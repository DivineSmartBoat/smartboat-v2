<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PurchaseImport;

class PurchaseImportController extends Controller
{
    /**
     * Show Import Page
     */
    public function index()
    {
        return view('admin.purchase.import');
    }

    /**
     * Import Purchase Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xlsx,xls'
        ]);

        Excel::import(new PurchaseImport, $request->file('file'));

        return back()->with('success', 'Purchase Report Imported Successfully.');
    }
}