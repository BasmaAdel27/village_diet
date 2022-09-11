<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    const ACTIVE = 'active';
    const IN_ACTIVE = 'in_active';
    const REQUEST_CANCEL = 'request_cancel';
    const FINISHED = 'finished';

    const STATUSES = [self::ACTIVE, self::IN_ACTIVE, self::REQUEST_CANCEL];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
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
