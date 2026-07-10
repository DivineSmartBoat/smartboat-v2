<?php

namespace App\Services;

class CountryService
{
    /**
     * Return country code.
     * If Excel value is empty, use +91.
     */
    public static function getCode(?string $country = null): string
    {
        if (empty($country)) {
            return '+91';
        }

        $country = strtolower(trim($country));

        $codes = [
            'india' => '+91',
            'bangladesh' => '+880',
            'nepal' => '+977',
            'bhutan' => '+975',
            'usa' => '+1',
            'united states' => '+1',
            'uk' => '+44',
            'united kingdom' => '+44',
            'canada' => '+1',
            'australia' => '+61',
            'uae' => '+971',
            'singapore' => '+65',
        ];

        return $codes[$country] ?? '+91';
    }
}