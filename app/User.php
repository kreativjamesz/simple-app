<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = ['url', 'avatar'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        //return route("question.show", $this->id);
        return '/';
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    
    public function getAvatarAttribute()
    {
        $email = $this->email;
        //$default = "https://www.somewhere.com/homestar.jpg";
        $size = 24;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); //,'user_id','question_id');
    }

    // Two relationship method for questions and answers
    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }
    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $votes)
    {
        // User votes to a Question
        $voteQuestions = $this->voteQuestions();

        $this->_vote($voteQuestions, $question, $votes);

        // if($voteQuestions->where('votable_id', $question->id)->exists()){
        //     $voteQuestions->updateExistingPivot($question,['votes' => $votes]);
        // } else {
        //     $voteQuestions->attach($question, ['votes' => $votes]);
        // }
        
        // $question->load('votes'); // loads the votes data from database
        // $upVotes = (int) $question->upVotes()->sum('votes'); // 
        // // $upVotes = (int) $question->votes()->wherePivot('vote',1)->sum('vote'); // 
        // $downVotes = (int) $question->downVotes()->sum('votes'); // 
        // // $downVotes = (int) $question->votes()->wherePivot('vote',-1)->sum('vote'); // 
        // $question->votes_count = $upVotes + $downVotes;
        // $question->save();
    }

    public function voteAnswer(Answer $answer, $votes)
    {
        // User votes to a Question
        $voteAnswers = $this->voteAnswers();

        $this->_vote($voteAnswers, $answer, $votes);

        // if($voteAnswers->where('votable_id', $answer->id)->exists()){
        //     $voteAnswers->updateExistingPivot($answer,['votes' => $votes]);
        // } else {
        //     $voteAnswers->attach($answer, ['votes' => $votes]);
        // }
        
        // $answer->load('votes'); // loads the votes data from database
        // $upVotes = (int) $answer->upVotes()->sum('votes'); // 
        // // $upVotes = (int) $answer->votes()->wherePivot('vote',1)->sum('vote'); // 
        // $downVotes = (int) $answer->downVotes()->sum('votes'); // 
        // // $downVotes = (int) $answer->votes()->wherePivot('vote',-1)->sum('vote'); // 
        // $answer->votes_count = $upVotes + $downVotes;
        // $answer->save();
    }

    private function _vote($relationship, $model, $votes)
    {
        // User votes to a Question
        if($relationship->where('votable_id', $model->id)->exists()){
            $relationship->updateExistingPivot($model,['votes' => $votes]);
        } else {
            $relationship->attach($model, ['votes' => $votes]);
        }
        
        $model->load('votes'); // loads the votes data from database
        $upVotes = (int) $model->upVotes()->sum('votes'); // 
        // $upVotes = (int) $model->votes()->wherePivot('vote',1)->sum('vote'); // 
        $downVotes = (int) $model->downVotes()->sum('votes'); // 
        // $downVotes = (int) $model->votes()->wherePivot('vote',-1)->sum('vote'); // 
        $model->votes_count = $upVotes + $downVotes;
        $model->save();
    }

}
