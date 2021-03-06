<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Un utilisateur est associé à un rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Un utilisateur peut avoir plusieurs missions
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Un utilisateur peut avoir plusieurs "likes"
     */
    public function likes()
    {
        return $this->belongsToMany(Job::class);
    }

    /**
     * Un utilisateur peut envoyer plusieurs propositions
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * Un utilisateur peut potentiellement avoir plusieurs discussions différentes
     * Etant donné qu'il s'agit d'une table particulière je n'ai pas pu utiliser une méthode de relation de Laravel
     */
    public function conversations()
    {
        return Conversation::where(function ($q) {
            return $q->where('to', $this->id)
                ->orWhere('from', $this->id);
        });
    }    

    public function getConversationsAtrribute()
    {
        return $this->conversations()->get();
    }
}
