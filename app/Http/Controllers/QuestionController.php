<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\NewQuestionRequest;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index', compact('questions'));
        // view('questions.index', compact('questions'))->render();
        // dd($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title','body'));

        
        return redirect()->route('questions.index')->with('success','Question summited');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // dd($question);
        // Anytime a user click show, a question should
        // increments it's views with
        // $question->views = $question->views + 1;
        // $question->save();

        // Now simplifies with
        $question->increment('views');
        return view('questions.show',compact('question'));

        // dd($question->title);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        $this->authorize('update',$question);
        if(Gate::allows('update-question', $question)) {
            return view('questions.edit',compact('question'));
        }
        abort(403,"You do not have access to given action");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(NewQuestionRequest $request, Question $question)
    {
        $this->authorize("update",$question);
        $question->update($request->only('title','body'));
        return redirect('/questions')->with('success','Question has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete",$question);
        if(Gate::denies('delete-question', $question)) {
            abort(403,"No permission on given action");
        }
        $question->delete();

        return redirect('/questions')->with('success',"The question has been removed!");

    }
}
