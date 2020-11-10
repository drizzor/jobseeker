<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    /**
     * Methode Scope permettant de definir une règle spécifique lorsque je récupère ici mes jobs (voir Local Scopes)
     *
     */
    public function scopeOnline($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Un job appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
