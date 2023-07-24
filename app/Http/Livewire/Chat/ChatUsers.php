<?php

namespace App\Http\Livewire\Chat;

use App\Models\Conversation;
use App\Models\User;
use Livewire\Component;

class ChatUsers extends Component
{
    public function render()
    {
        return view('livewire.chat.chat-users', [
            // dd(auth()->id()),

            'users' => User::where('id', '!=', auth()->user()->id)->get()
        ]);
    }
    public function message($userId)
    {

        //  $createdConversation =   Conversation::updateOrCreate(['sender_id' => auth()->id(), 'receiver_id' => $userId]);
        // dd($userId);
        $authenticatedUserId = auth()->id();

        # Check if conversation already exists

        $existingConversation = Conversation::Where('sender_id', $authenticatedUserId)->where('receiver_id', $userId)
            ->orWhere(function ($q) use ($authenticatedUserId, $userId) {
                $q->where('receiver_id',  $authenticatedUserId)->where('sender_id', $userId);
            })->first();

        // dd($existingConversation);

        if ($existingConversation) {
            # Conversation already exists, redirect to existing conversation
            return redirect()->route('chat.index', ['query' => $existingConversation->id]);
        }

        # Create new conversation
        $createdConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $userId,
        ]);

        return redirect()->route('chat.index', ['query' => $createdConversation->id]);
    }
}
