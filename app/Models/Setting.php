<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];
    const FIXED = 'fixed';
    const PERCENT = 'percent';
    const TAX_TYPES = [self::FIXED, self::PERCENT];
}
