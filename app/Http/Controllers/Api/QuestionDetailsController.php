<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\QuestionDetailsResource;
use App\Question;
use App\Http\Controllers\Controller;

class QuestionDetailsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Question $question
     * @return QuestionDetailsResource
     */
    public function __invoke(Question $question)
    {
        $question->increment('views');

        return new QuestionDetailsResource($question);
    }
}
