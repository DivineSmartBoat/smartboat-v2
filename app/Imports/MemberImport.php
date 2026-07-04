<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'smart_id' => $row['member_id'] ?? null,
            'name' => trim($row['name'] ?? ''),
            'email' => strtolower(trim($row['email'] ?? '')),
            'mobile' => preg_replace('/[^0-9]/', '', $row['phone'] ?? ''),
            'sponsor_id' => $row['sponsor'] ?? null,
            'password' => Hash::make('12345678'),
        ]);
    }
}

