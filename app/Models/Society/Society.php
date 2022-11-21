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
            $sender = SocietyChat::where([['sender_id', auth()->id()], ['society_id', $society_id]])->orderBy('id', 'DESC')->first();
        if ($sender) {
            if ($sender->read_at == null) {
                $count = SocietyChat::where([['id', '>', $sender->id], ['society_id', $society_id]])->count();
                return $count;
            }else{
              return $count=0;
            }
        }else{
                $unreadMsgs = SocietyChat::where('society_id', $society_id)->get();


            if ($unreadMsgs) {
                $seenmsgs=array();
                    foreach ($unreadMsgs as $unreadMsg) {
                        $data=SeenMessage::where([['message_id', $unreadMsg->id], ['user_id', auth()->id()]])->get();
                        if ($data->isNotEmpty()){
                            $seenmsgs[]=$data;
                        }
                    }
                    if (sizeof($seenmsgs)) {

                        return count($unreadMsgs)-count($seenmsgs);
                    }else{
                        return count($unreadMsgs) ;

                    }
                }else{
                    return 0;
                }

        }

        }

}
