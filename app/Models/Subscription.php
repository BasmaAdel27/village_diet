<?php

namespace App\Models;

use App\Traits\HasTimestampTrait;
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
    const ACTIVE_AR = 'مفعل';
    const INACTIVE_AR = 'معطل';
    const REQUEST_CANCEL_AR = 'ملغي';
    const FINISHED_AR = 'منتهي';

    const STATUSES = [self::ACTIVE, self::IN_ACTIVE, self::REQUEST_CANCEL, self::FINISHED];
    const STATUSES_AR = [self::ACTIVE_AR, self::INACTIVE_AR, self::REQUEST_CANCEL_AR, self::FINISHED_AR];

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
}
