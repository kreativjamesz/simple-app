<?php

namespace App\Policies;

use App\Answer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;

    
    public function update(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }

    // Match the current user_id to the user_id that creates the question
    public function accept(User $user, Answer $answer)
    {
        return $user->id === $answer->question->user_id;
    }
    
    public function delete(User $user, Answer $answer)
    {
        return $user->id === $answer->user_id;
    }

  
}
