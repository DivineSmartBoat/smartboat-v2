<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class MemberProfile extends Model
{
    use Notifiable;

    protected $fillable = [
        'smart_id',
        'full_name',
        'email',
        'country_code',
        'mobile',
        'date_of_birth',
        'gender',
        'real_sponsor_id',
        'rising_sponsor_id',
        'real_sponsor_smart_id',
        'rising_sponsor_smart_id',
        'password',
        'transaction_password',
        'terms',
        'is_active',
        'registration_datetime',
        'first_purchase_datetime',   ];
'last_purchase_datetime',
'purchase_count',
'total_purchase_amount',
    protected $hidden = [
        'password',
        'transaction_password',
    ];

    protected $casts = [
    'date_of_birth' => 'date',
    'terms' => 'boolean',
    'is_active' => 'boolean',
    'registration_datetime' => 'datetime',
    'first_purchase_datetime' => 'datetime',
    'last_purchase_datetime' => 'datetime',
];
public function setPasswordAttribute(string $value): void
{
    $this->attributes['password'] = Hash::needsRehash($value)
        ? Hash::make($value)
        : $value;
}

public function setTransactionPasswordAttribute(string $value): void
{
    $this->attributes['transaction_password'] = Hash::needsRehash($value)
        ? Hash::make($value)
        : $value;
}

public function realSponsor()
{
    return $this->belongsTo(
        self::class,
        'real_sponsor_id'
    );
}

public function risingSponsor()
{
    return $this->belongsTo(
        self::class,
        'rising_sponsor_id'
    );
}
