<?php

namespace App\Http\Livewire;

use App\Models\Job;
use Livewire\Component;

class Search extends Component
{
    public $query = '';
    public $jobs = [];
    public $selectedIndex = 0;

    public function render()
    {
        return view('livewire.search');
    }

    /**
     * Ici j'exploite le hook updated de livewire : https://laravel-livewire.com/docs/2.x/lifecycle-hooks
     */
    public function updatedQuery()
    {
        $words = "%" . $this->query . "%";
        
        if(strlen($this->query) > 2) {
            $this->jobs = Job::where('title', 'like', $words)
            ->orWhere('description', 'like', $words)
            ->get();
        }        
    }

    /**
     * Afficher la mission sur laquelle la touche "enter" a été appuyée
      */
    public function showJob()
    {
        if($this->jobs->isNotEmpty()) {
            return redirect()->route('jobs.show', [
                $this->jobs[$this->selectedIndex]['id'],
            ]);
        }
    }

    /**
     * Incremente l'index de liste de recherche pour passer à la recherche suivante avec arrow-down
     */
    public function incrementIndex()
    {
        if($this->selectedIndex === count($this->jobs) - 1) {
            $this->selectedIndex = 0;
            return;
        }
        
       $this->selectedIndex++; 
    }   

    /**
     * Decremente l'index de liste de recherche pour passer à la recherche suivante avec arrow-up
     */
    public function decrementIndex()
    {
        if($this->selectedIndex === 0) {
            $this->selectedIndex = (count($this->jobs) - 1);
            return;
        }

        $this->selectedIndex--;
    }

    /**
     * Reset de l'index si je quitte le focus de la barre de recherche
     */
    public function resetIndex()
    {
        $this->reset('selectedIndex');
    }
}
