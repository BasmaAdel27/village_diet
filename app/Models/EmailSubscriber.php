<?php

namespace App\Models;

use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSubscriber extends Model
{
    use HasFactory, HasTimestampTrait;

    protected $guarded = [];

    const BASIC = 'basic';
    const TEMPLATES = [self::BASIC];
}
