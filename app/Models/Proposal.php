<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = ['job_id', 'validated'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    /**
     * Une proposition appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Une proposition est associée à une mission/job
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Une proposition est associée à une seule lettre - relation 1 à 1
     * Relation plutot rare belongsTo / hasOne
     */
    public function coverLetter()
    {
        return $this->hasOne(CoverLetter::class);
    }
}
