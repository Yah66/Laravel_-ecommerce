<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id'];

    /**
     * Get all of the messages for the Conversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getReceiver()
    {
        if (auth()->user()->id === $this->sender_id) {
            return User::find($this->receiver_id);
        } else {
            return User::find($this->sender_id);
        }
    }

    public function scopeWhereNotDeleted($query)
    {
        $userId = auth()->id();

        return $query->where(function ($query) use ($userId) {

            #where message is not deleted
            $query->whereHas('messages', function ($query) use ($userId) {

                $query->where(function ($query) use ($userId) {
                    $query->where('sender_id', $userId)
                        ->whereNull('sender_deleted_at');
                })->orWhere(function ($query) use ($userId) {

                    $query->where('receiver_id', $userId)
                        ->whereNull('receiver_deleted_at');
                });
            })
                #include conversations without messages
                ->orWhereDoesntHave('messages');
        });
    }



    public  function isLastMessageReadByUser(): bool
    {


        $user = Auth()->User();
        $lastMessage = $this->messages()->latest()->first();

        if ($lastMessage) {
            return  $lastMessage->read_at !== null && $lastMessage->sender_id == $user->id;
        }
    }




    public  function unreadMessagesCount(): int
    {


        return $unreadMessages = Message::where('conversation_id', '=', $this->id)
            ->where('receiver_id', auth()->user()->id)
            ->whereNull('read_at')->count();
    }
}
