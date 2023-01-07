<?php

namespace App\Models;

use App\Models\Chat\AdminMessage;
use App\Models\Chat\TrainerMessage;
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

    protected $dates = ['date_of_birth'];

    public $assets = ['image'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
    public function society()
    {
        return $this->belongsTo(Society::class);
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

    public function currentSubscription()
    {
        if ($this->society()->exists()) {
            return $this->hasOne(Subscription::class)
                ->whereIn('status', [Subscription::ACTIVE, Subscription::REQUEST_CANCEL, Subscription::IN_ACTIVE])->latest('id');
        }

        return $this->hasOne(Subscription::class)->whereIn('status', [Subscription::ACTIVE, Subscription::IN_ACTIVE])->latest('id');
    }

    public function isSubscriptionFinished()
    {
        // Finished => True
        return $this->currentSubscription()->where('end_date', '<=', now()->endOfDay())->exists();
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

    public function societies()
    {
        return $this->hasMany(Society::class, 'trainer_id');
    }

    public function getFullNameAttribute() // notice that the attribute name is in CamelCase.
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function lastMessage()
    {
        return $this->hasOne(AdminMessage::class, 'receiver_id')->latestOfMany();
    }
    #endregion relationship

    public function messagesCount($user_id)
    {
        $counts = AdminMessage::where([['receiver_id', auth()->id()], ['read_at', null], ['sender_id', $user_id]])->count();
        return $counts;
    }

    public function messagesCountTrainer($user_id)
    {
        $counts = TrainerMessage::where([['receiver_id', auth()->id()], ['read_at', null], ['sender_id', $user_id]])->count();
        return $counts;
    }
}
