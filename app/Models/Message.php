<?php

//namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;

//class Message extends Model
//{
  //  use HasFactory;

    //protected $fillable = ['conversation_id', 'sender_id', 'content', 'is_read'];

    //public function sender()
    //{
      //  return $this->belongsTo(User::class, 'sender_id');
    //}

    //public function conversation()
    //{
      //  return $this->belongsTo(Conversation::class);
    //}


//}
//class Message extends Model
//{
   // protected $fillable = [
      //  'conversation_id',
       // 'user_id',
       // 'text'
   // ];

   // public function user() {
     //   return $this->belongsTo(User::class);
   // }
//}


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'user_id',
        'text',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


