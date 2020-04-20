<?php

namespace App;

trait VotableTrait
{
  public function votes()
  {
      return $this->morphToMany(User::class, 'votable');
  }
  public function upVotes()
  {
      return $this->votes()->wherePivot('votes', 1);
  }

  public function downVotes()
  {
      return $this->votes()->wherePivot('votes',-1);
  }
}