<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * Methode Scope permettant de definir une règle spécifique lorsque je récupère mes jobs (voir Local Scopes)
     *
     */
    public function scopeOnline($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Un job appartient à un utilisateur - auteur de la mission
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Un job peut etre 'liké' par plusieurs utilisateurs
     */
    public function likes()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * L'utilisateur aime-t-il la mission?
     */
    public function isLiked()
    {
        if(auth()->check()) {
            return auth()->user()->likes->contains('id', $this->id);
        }
    }

    /**
     * Un job peut avoir plusieurs propositions/demandes
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}
