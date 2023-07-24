<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'receiver_id',
        'read_at',
        'receiver_deleted_at',
        'sender_deleted_at',
        'body'
    ];

    protected $dates = ['receiver_deleted_at', 'sender_deleted_at', 'read_at'];

    /**
     * Get the user that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function isRead()
    {
        return $this->read_at != null;
    }
}
