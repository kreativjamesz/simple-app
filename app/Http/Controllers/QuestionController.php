<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(){
        $questions = Question::latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }
    public function store(Request $request){}
    public function create(){}
    public function show(Question $question){}
    public function edit(Question $question){}
    public function update(Request $request, Question $question){}
    public function destroy(Question $question){}
}
