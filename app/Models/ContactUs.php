<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TRAINER = 'trainer';
    const USER = 'user';
    const USER_TYPES = [self::TRAINER, self::USER];

    const COMPLAINT = 'complaint';
    const INQUIRY   = 'inquiry';
    const SUGGESTION = 'suggestion';
    const MESSAGE_TYPES = [self::COMPLAINT, self::INQUIRY, self::SUGGESTION];
}
