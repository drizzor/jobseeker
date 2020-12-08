<?php

namespace App\Http\Livewire;

use App\Notifications\JobLiked;
use Livewire\Component;

class Job extends Component
{
    public $job;

    public function render()
    {
        return view('livewire.job');
    }

    /**
     * Ajout d'un like sur la mission cible (cliquée)
     */
    public function addLike()
    {   
        if(auth()->check()) {
            $response = auth()->user()->likes()->toggle($this->job->id);

            // attached pour liké si c'était pour vérifier le non liké -> detached
            if($response['attached'] && auth()->user()->id != $this->job->user->id)
                $this->job->user->notify(new JobLiked($this->job));
                
        } else {            
            // event flash message
            $this->emit('flash', 'Merci de vous connecter pour ajouter une mission à vos favoris.', 'error');
        }        
    }
}
