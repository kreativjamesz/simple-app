- A USER can set 1x a certain question.
- A QUESTION can set as favorite by more than 1 USER
- The relationship will be: Many to Many

// Current user
$user = App\User::first();

// User's list of favorites
$user->favorites

// Get the 1st question
$q1 = App\Question::find(1);

// Get the 2nd question
$q2 = App\Question::find(2);

// Get the 1st User
$u1 = App\User::find(1);

// Get the 2nd User
$u2 = App\User::find(2);

// Get the 3rd User
$u3 = App\User::find(3);

// Check User 1's favorites
$u1->favorites

// Check User 2's favorites
$u2->favorites

// Check Question 1's list of favorited Users
$q1->favorites

// Check Question 2's list of favorited Users
$q2->favorites

// Attaching Question 1 into User 1's favorite questions
$u1->favorites()->attach($q1->id);
// Attaching Question 2 into User 1's favorite questions
$u1->favorites()->attach($q2);

// And to get the attachedd favorites to a certain User - we should declare.
$u1->load('favorites');

// And if we check User 1's list of favorite questions
$u1->favorites();

// Also, it receives arrays contains Integer values
$u2->favorites()->attach([$q1->id,$q2->id]);

// If we try to record the same data it will throw a duplicate entry error key
// So, for that, we need to detach a certain data if it's already recorded
$u1->favorites()->detach($q2);

// And so we need to load again the data after detaching to favorites
$u1->load('favorites)->favorites

// We can also detach through array by apply detach method
$u2->favorites()->detach([$q1->id,$q2->id]);
// And load the data after detaching
$u2->load('favorites)->favorites

// And now we can also check if a particular Question favorited by partical User
$q1->favorites()->where('user_id',$user->id)->count() > 0;
=> false

VOTING THE QUESTION
* A question can be voted by more than one user
* An answer can be voted by more than one user
* A user can votes more than one question (can only vote a unique question)
* A user can vote more than one answer (can only vote a unique answer)
Relationship Options
* Many to Many relationship
* Many to Many Polymorphic Relationship

DATA COLLECTIONS

questions             users                 answers
+-----------------+   +-----------------+   +------------------+
| id | title      |   | id | name       |   | id | question_id |
| 1  | Question 1 |   | 1  | Andy       |   | 1  | 1           |
| 2  | Question 2 |   | 2  | Bob        |   | 2  | 2           |
+-----------------+   +-----------------+   +------------------+

MANY TO MANY RELATIONSHIP

votes_questions                     votes_answers
+-------------------------------+   +-------------------------------+
| user_id | question_id | like  |   | user_id | answer_id   | like  |
| 1       | 1           |  1    |   | 1       | 1           | -1    |
| 2       | 1           | -1    |   | 1       | 2           |  1    |
| 2       | 2           |  1    |   | 2       | 2           |  1    |
+-------------------------------+   +-------------------------------+


MANY TO MANY POLYMORPHIC RELATIONSHIP
votable_data
+----------------------------------------------+
| user_id | votable_id  | votable_type  | like |
| 1       | 1           | App\Question  |  1   |
| 2       | 1           | App\Answer    | -1   |
| 2       | 2           | App\Question  |  1   |
| 2       | 2           | App\Answer    |  1   |
+----------------------------------------------+

TINKER POLYMORPHIC
// Find users
$u1 = App\User::find(1);
$u2 = App\User::find(2);

// Find questions
$q1 = App\Question::find(1);
$q2 = App\Question::find(2);

// Find first answers of questions
$a1 = $q1->answers->first();
$a2 = $q2->answers->first();

// Attaching Vote on Questions and Answers
$u1->voteQuestions()->attach($q1,['vote'=> 1]); // User #1 Votes Up for Question #1
$u2->voteQuestions()->attach($q1,['vote'=> -1]); // User #2 Votes Down for Question #1
$u1->voteAnswer()->attach($a1,['vote'=> 1]); // User #1 Votes Up for Answer #1
$u2->voteAnswer()->attach($a1,['vote'=> -1]); // User #2 Votes Down for Answer #1
$u1->voteAnswer()->updateExistingPivot($a1,['vote'=>-1]); // Binawi yung vote, votes down a voted up answer.
$u2->voteAnswer()->updateExistingPivot($a2,['vote'=>-1]); // Binawi yung vote, votes down a voted up answer.


// Check the votes
$q1->votes
$q1->votes

// To see Pivots
$q1->votes()->withPivot('votes')->get();

// How to know, how many users votes to a question
$q1->votes()->wherePivot('pivot',-1)->count();
=> 1
// Summing the votes
$q1->votes()->wherePivot('pivot',-1)->sum('vote');
=> "-1"
// How to see how many users vote to a question
$q1->votes()->wherePivot('pivot',1)->sum('vote');
=> "1"
