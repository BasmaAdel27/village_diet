<?php

namespace App\Models;

use App\Models\Country\Country;
use App\Models\Society\Society;
use App\Models\State\State;
use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use MattDaneshvar\Survey\Models\Entry;
use Spatie\Permission\Traits\HasRoles;
use willvincent\Rateable\Rateable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasAssetsTrait, HasTimestampTrait, Rateable;

    public $assets = ['image'];

    protected $guarded = [];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('admin') && $this->email == config('permission.admin_user_name');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }


    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    #region relationships
    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function getImageAttribute()
    {
        if ($this->images()->where('option','image')->value('media')) {
            dd('hh');
            return asset($this->images()->where('option','image')->value('media'));
        }

        return in_array($this->entry?->gender, ['Male', 'ذكر', null]) ?
            asset('adminPanel/images/faces/male.webp') :
            asset('adminPanel/images/faces/female');
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)->latest('id')->where('status', Subscription::ACTIVE);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function trainer()
    {
        return $this->hasOne(Trainer::class);
    }

    public function healthyInformation()
    {
        return $this->hasMany(HealthyInformation::class);
    }

    public function entry()
    {
        return $this->hasOne(Entry::class, 'participant_id')
            ->whereHas('survey', fn ($q) => $q->where('name', (app()->getLocale() == 'ar' ? 'النموذج الصحي' : 'Health Model')));
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


    #endregion relationship
}
