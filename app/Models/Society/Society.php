<?php

namespace App\Models\Society;

use App\Models\Chat\SocietyChat;
use App\Models\SeenMessage;
use App\Models\User;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Society extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait;

    public $translatedAttributes = ['title'];
    protected $fillable = ['is_active', 'date_from', 'trainer_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(SocietyChat::class, 'society_id');
    }

    public function msgCount($society_id)
    {
        $senders=SocietyChat::pluck('sender_id')->toArray();
        if ($senders){
        if (in_array(auth()->id(),$senders)) {
            $sender = SocietyChat::where([['sender_id', auth()->id()], ['society_id', $society_id], ['read_at', null]])->orderBy('id', 'DESC')->first();
            if ($sender) {
                $count = SocietyChat::where([['id', '>', $sender->id], ['society_id', $society_id]])->count();
                return $count;

            }else{
                $count=0;
                return $count;
            }
        }
        else {
            $count= SocietyChat::where([['society_id', $society_id]])->count();
               return $count;
        }

        }else{
            $count=0;
            return $count;
        }

    }

}
