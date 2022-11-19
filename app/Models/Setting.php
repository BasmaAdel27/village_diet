<?php

namespace App\Models;

use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasTimestampTrait;

    protected $guarded = [];
    const FIXED = 'fixed';
    const PERCENT = 'percent';
    const TAX_TYPES = [self::FIXED, self::PERCENT];


    public function getTaxAmountAttribute()
    {
        if ($this->attributes['tax_type'] == 'fixed') return $this->attributes['tax_amount'];
        if ($this->attributes['tax_type'] != 'fixed') {
            return (($this->attributes['net_subscription'] * $this->attributes['tax_amount']) / 100);
        }
    }
}
