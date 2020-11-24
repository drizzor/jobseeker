<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverLetter extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_id', 'content'];

    /**
     * Une lettre de motivation est attribuée à une proposition
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
