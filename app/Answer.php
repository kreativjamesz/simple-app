<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    
    protected $fillable = ['body','user_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute() 
    {
        return \Parsedown::instance()->text($this->body);
    }

    public static function boot()
    {
        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

        static::deleted(function($answer){
            // Prevent deleting the best answer
            // $question = $answer->question;
            $answer->question->decrement('answers_count');
            // if($question->best_answer_id === $answer->id) {
            //     $question->best_answer_id = NULL;
            //     $question->save();
            // }
            // $answer->question->decrement('answers_count');
        });
        
        // static::created(function($answer){
        //     echo "Answer saved\n";
        // });
    }
    
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        // Mark as accepted logic
        //return $this->id === $this->question->best_answer_id ? 'vote-accepted text-success' : '';
        return $this->isBest() ? 'vote-accepted text-success' : '';
    }

    public function getIsBestAttribute()
    {
        return $this->isBest();
    }

    public function isBest()
    {
        return $this->id === $this->question->best_answer_id;
    }
}
