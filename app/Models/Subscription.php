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
        return $this->attributes['status'] = $value;
    }
}
