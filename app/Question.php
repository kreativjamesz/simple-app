<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title','body'];
    
    // We may now be able to get the User created the question.
    public function user() {
        return $this->belongsTo(User::class);
    }
}
