<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;


class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function __invoke(Question $question)
    {
        // Capturing the vote value & make sure that its an Integer
        $vote = (int) request()->vote;
        // Get the current user
        auth()->user()->voteQuestion($question, $vote);
        // Return back
        return back();
    }
}
