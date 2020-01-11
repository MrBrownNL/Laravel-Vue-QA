<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{

    public function __invoke(Question $question)
    {
        $vote = (int)request()->vote;
        $oldVotesCount = $question->votes_count;
        $votesCount = auth()->user()->voteQuestion($question, $vote);

        return response()->json([
            'message' => "Thanks for the feedback!",
            'oldVotesCount' => $oldVotesCount,
            'votesCount' => $votesCount
        ]);
    }
}
