<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class Conversation extends Component
{
    public $conversation;

    public $message = '';
    protected $listeners = ['sent' => '$refresh'];

    public function mount($conversation)
    {
        $this->conversation = $conversation;
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
