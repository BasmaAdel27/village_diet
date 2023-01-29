<?php

namespace App\Models;

use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, HasTimestampTrait;

    protected $guarded = [];
    protected $dates = ['end_date'];

    const ACTIVE = 'active';
    const IN_ACTIVE = 'in_active';
    const REQUEST_CANCEL = 'request_cancel';
    const FINISHED = 'finished';

    const STATUSES = [self::ACTIVE, self::IN_ACTIVE, self::REQUEST_CANCEL, self::FINISHED];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDateBetween(Builder $query, $date_from, $date_to)
    {
        $query->when(
            request()->has('date_from'),
            fn ($q) => $q->where('created_at', '>=', $date_from)
        )
            ->when(
                request()->has('date_to'),
                fn ($q) => $q->where('created_at', '<=', $date_to)
            );
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status_ar'] = trans($value);
        $this->attributes['status'] = $value;
    }

    public static function calculateSubscription($code = null)
    {
        $discount = 0;
        $setting = Setting::first();
        $netSubscription = $setting->net_subscription;
        $taxAmount = $setting->tax_amount;
        $coupon = Coupon::whereColumn('used_times', '<', 'max_used')
            ->where('end_date', '>=', now()->addDay()->endOfDay())
            ->where('code', $code)->first();

        $subTotal = $netSubscription + $taxAmount;

        if ($coupon) {
            $discount = ($coupon->coupon_type == 'fixed') ? $coupon->amount : ($subTotal * $coupon->percent) / 100;
        }
        $total = $subTotal - $discount;

        return [
            'amount' => $netSubscription,
            'tax_amount' => $taxAmount,
            'coupon' => $coupon,
            'total' => $total,
            'discount' => $discount
        ];
    }
}
