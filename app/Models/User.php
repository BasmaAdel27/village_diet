<?php

namespace App\Models;

use App\Models\Country\Country;
use App\Models\Society\Society;
use App\Models\State\State;
use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'user_number',
        'phone',
        'date_of_birth',
        'is_active',
        'address',
        'insta_link',
        'twitter_link',
        'wrong_attemp_count',
        'country_id',
        'state_id',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
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
    public function societies()
    {
        return $this->belongsToMany(Society::class, 'user_societies');
    }

    public function getImageAttribute()
    {
        if ($this->images()->whereOption('image')->value('media')) {
            return asset($this->images()->whereOption('image')->value('media'));
        }

        return in_array($this->entry?->gender, ['Male', 'ذكر', null]) ?
            asset('adminPanel/images/faces/male.webp') :
            asset('adminPanel/images/faces/female');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id');
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
