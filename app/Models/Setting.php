<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'net_subscription',
        'tax_name',
        'tax_amount',
        'ios_version',
        'android_version',
        'website_url',
        'web_description',
        'logo',
        'is_link_active',
        'forced_android',
        'forced_ios',
        'optional_android',
        'optional_ios',
        'web_maintenance',
        'android_maintenance',
        'ios_maintenance',
        'footer'
    ];
    const FIXED = 'fixed';
    const PERCENT = 'percent';
    const TAX_TYPES = [self::FIXED, self::PERCENT];
}
