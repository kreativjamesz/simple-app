<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AnswersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index(){}

    public function create(){}

    public function store(Question $question, Request $request)
    {
        // $user = auth()->user();
        // var_dump($user->id);
        // Method 1
        // $question->validate($request, [
        //     'body' => 'required',
        // ]);
        // $question->answers()->create(['body' => $request->body, 'user_id' => \Auth::id()]);

        // Method 2
        $question->answers()->create($request->validate([
            'body' => 'required',
        ]) + ['user_id' => Auth::id()]);

        return back()->with('success','Your answer has been submitted succesfully');
    }

    public function show(Answer $answer){}

    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        if(Gate::allows('update-answer', $answer)) {
            return view('answers.edit', compact('question','answer'));
        }
        abort(403,"You do not have access to edit this answer");
    }

    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body' => 'required',
        ]));
        // dd($answer);
        return redirect()->route('questions.show',$question->slug)->with('success','Your answer has been submitted!');
    }

    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize("delete",$answer);
        if(Gate::denies('delete-answer', $answer)) {
            abort(403,"No permission on deleting this given answer");
        }
        $answer->delete();

        return back()->with('success',"Answer successfully removed!");
    }
}
