<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to', 'job_id'];

    /**
     * Le message provient de tel utilisateur
    */
    public function from()
    {
        return $this->belongsTo(User::class, 'from');
    }
    
    /**
     * Le message a été envoyé à tel utilisateur
     */
    public function to()
    {
        return $this->belongsTo(User::class, 'to');
    }

    /**
     * Une conversation peut avoir plusieurs messages
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Une conversation appartient à un job
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
