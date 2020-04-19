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

