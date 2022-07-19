<!--Siddharth Tiwari, 11/23/30, result page

    quarter project result page.

    links to:
        premium.html -> links to static page that tells user that premium is not developed yet
        index.php -> links back to homepage
  
    key features:
        "corrects" answers from the test.php form
        displays custom response based on score
        updates score in "info" table
        links to other pages
            
-->

<!DOCTYPE html>
<?php
//connects using config file and uses apData db
include_once 'config.php';
if (mysqli_select_db($conn, 'apData')) {
} else {
    if (mysqli_query($conn, "CREATE DATABASE apData")) {
    }
}

//init score var
$score = 0;

//retrieves question numbers from test.php
$questions = [];
//IDS for the hidden fields
$ID = ["Q1", "Q2", "Q3", "Q4", "Q5"];
for ($i = 0; $i < 5; $i++) {
    array_push($questions, $_POST[$ID[$i]]);
}

//retrieves seleted answers from test.php
$answers = [];
//IDs for the radio button groups
$ID = ["1", "2", "3", "4", "5"];
for ($i = 0; $i < 5; $i++) {
    array_push($answers, $_POST[$ID[$i]]);
}

//retrieves the correct answers from the 'Questions' database and checks if the selected answers match the correct answers
$correctAnswers = [];
for ($i = 0; $i < 5; $i++) {
    //use questions array to check each random question
    $sql = "SELECT * FROM Questions WHERE qID = '$questions[$i]'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        //use results from query to retrieve element
        while ($row = mysqli_fetch_assoc($result)) {
            //use correctRadio method to check if the selected answer is right
            $score += correctRadio($answers[$i], $row['correct']);
        }
    }
    
}

//function used to check if answers are the same and grant points
function correctRadio($answer, $correct)
{
    //converts selected answer to int
    $answer = intval($answer);
    //checks value
    if ($answer == $correct) {
        return 1;
    } else {
        return 0;
    }
}

//start the session to retrieve 'id' for current user
session_start();
//retrieve id
$id =  $_SESSION["user"];

//update score of user
$sql = "UPDATE info 
    SET 
        score = $score/5 * 100
    WHERE
        id = $id";
$result = mysqli_query($conn, $sql);


//display information based on score
//if user gets 4 or 5 correct answers, display scores and congratulate
if ($score > 3) {
    echo "
        <div id='header'>
            <h1>you passed the test :O</h1>
        </div>
        
        <div id='info'>
            <h2>congratulations!</h2>
            <h3>you received a score of " . $score / 5 * 100 . "%.</h3>
            <h4>although you did a *spectacular* job, you can achieve more with <b>sid's review premium</b>. with a premium membership, you receive unlimited practice quizzes and exclusive content (videos + study material)!</h4>
            <button><a href='premium.html' class='none'>upgrade!</a></button><br><br>
            <h4>click here to return to the home page:</h4>
            <button><a href='index.php' class='none'>home</a></button><br><br>
        </div>";
//if user gets 3 or less correct, then give user links and tell them that they can improve
} else {
    echo "<div id='header'>
            <h1>you did not pass the test :/</h1>
        </div>

        <div id='info'>
            <h2>drats >:(</h2>
            <h3>you received a score of " . $score / 5 * 100 . "%.</h3>
            <h4>here are some links to review this material:</h4>
            <a href='https://www.youtube.com/watch?v=vo4pMVb0R6M&list=PL8dPuuaLjXtOPRKzVLY0jJY-uHOH9KVU6' target='_blank'>hank green's ap psych crash course</a><br>
            <a href='https://fiveable.me/ap-psych' target='_blank'>tests + articles on fiveable</a>
            <h4>one quiz is not enough to improve your score. you can achieve more with <b>sid's review premium</b>, because you receive unlimited practice quizzes and exclusive content (videos + study material). keep at it. we believe in you.</h4>
            <button><a href='premium.html' class='none'>upgrade!</a></button><br>
            <h4>click here to return to the home page:</h4>
            <button><a href='index.php' class='none'>home</a></button><br>
        </div>";
}
?>


<html>

<head>
    <title>sid's review</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css?v=<?php echo time(); ?>">
</head>

<body>


    <div id="footer">
        <marquee behavior="scroll" direction="left"><b>NOTE: This is a quarter project for the Illinois Mathematics and Science Academy. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please do not take this seriously.</b></marquee>
    </div>

</body>

</html>