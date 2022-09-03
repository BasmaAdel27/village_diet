<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    const ACTIVE = 'active';
    const IN_ACTIVE = 'in_active';
    const REQUEST_CANCEL = 'request_cancel';
    const STATUSES = [self::ACTIVE, self::IN_ACTIVE, self::REQUEST_CANCEL];
}
