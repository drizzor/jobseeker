<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Conversation extends Component
{
    use AuthorizesRequests;
    
    public $conversation;

    public $message = '';
    protected $listeners = ['sent' => '$refresh'];

    public function mount($conversation)
    {
        $this->conversation = $conversation;
        
        $this->authorize('view', $conversation);
    }

    /**
     * Sauvegarde du message dans la BDD
     */
    public function sendMessage()
    {
       Message::create([
           'conversation_id' => $this->conversation->id, 
           'user_id' => auth()->user()->id, 
           'content' => $this->message, 
       ]); 

       $this->message = '';
       $this->emit('sent');
    }

    public function render()
    {
        return view('livewire.conversation');
    }
}
