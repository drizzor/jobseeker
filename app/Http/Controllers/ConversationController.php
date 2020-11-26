<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Liste des conversations
     */
    public function index()
    {
        $conversations = auth()->user()->conversations()->latest()->get();

        return view('conversations.index', compact('conversations'));
    }

    /**
     * Afficher une conversation gérée par livewire
     */
    public function show(Conversation $conversation)
    {
        return view('conversations.show', compact('conversation'));
    }
}
