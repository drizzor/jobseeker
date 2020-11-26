<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\CoverLetter;
use App\Models\Job;
use App\Models\Message;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function store(Request $request, Job $job)
    {
        $proposal = Proposal::create([
            'job_id' => $job->id,
            'validated' => false,
        ]);

        CoverLetter::create([
            'proposal_id' => $proposal->id,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    /**
     * Action de valider une cadidature de  mission
     */
    public function confirm(Request $request)
    {
        $proposal = Proposal::findOrFail($request->proposal);

        $proposal->fill(['validated' => 1]);

        // isDirty méthode permettant de vérifier s'il y a une modification d'un attribut du model avant sauvegarde
        if($proposal->isDirty()) {
            $proposal->save();

            $conversation = Conversation::create([
                'from' => auth()->user()->id,
                'to' => $proposal->user->id,
                'job_id' => $proposal->job->id,
            ]);

            Message::create([
                'conversation_id' => $conversation->id,
                'user_id' => auth()->user()->id,
                'content' => "Bonjour j'ai validé votre offre.",
            ]);

            return redirect()->route('jobs.index');
        }
    }
}
