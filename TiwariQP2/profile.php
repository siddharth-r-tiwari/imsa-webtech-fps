<!--Siddharth Tiwari, 11/23/30, Profile page

    quarter project profile page.

    links to:
        premium.html -> links to static page that tells user that premium is not developed yet
        test.php -> links to randomly generated test for user
  
    key features:
        checks if user has taken test yet, and if signin credentials are correct
        links to other pages
            
-->

<?php
//start the session --> if the user successfully logs in, the website needs to know the user's id
session_start();

//include config.php file to connect
include_once 'config.php';

//select db
if (mysqli_select_db($conn, 'apData')) {
} else {
    if (mysqli_query($conn, "CREATE DATABASE apData")) {
    }
}

//use post to retrieve user input from signinForm in index.php
$username = mysqli_real_escape_string($conn, $_POST['username_SI']);
$password = md5(mysqli_real_escape_string($conn, $_POST['password_SI'])); //encrypt password so it can be compared with password in database

//two checks after username/password check:
//first check --> if user has a score that is not null, that means that they cannot take another quiz
$sqlCheck = "SELECT * FROM info WHERE user = '$username' and score iS NOT NULL";
$resultCheck = mysqli_query($conn, $sqlCheck);

//second check --> if the user provides a valid username and password but has not taken a quiz, the option to take a quiz is given
$sql = "SELECT * FROM info WHERE user = '$username'";
$result = mysqli_query($conn, $sql);


//first check
if (mysqli_num_rows($resultCheck) > 0) {
    //retrieve first name and score so it can be displayed on the page
    while ($row = mysqli_fetch_assoc($result)) {
        $fName = $row['firstName'];
        $score = $row['score'];
    }
    //resulting page
    echo "
       <div id='header'>
            <h1>welcome!</h1>
        </div>
        
        <div class='row'>
            <div class='column' id='signin'>
                <br><br><br>
                <div class='hyperspan'>
                    <h2>QUIZ TAKEN</h2>
                    <p>dear <b>$fName</b>, you have already taken your free quiz. you earned a score of <b>$score%</b>. to take more quizzes, upgrade to premium; this is only a *taste* of what premium members receive as a part of their membership at <b>sid's review</b>!</p>
                    <img src='psych1.jpg' height='380px'>
                </div><br><br><br><br><br><br><br><br>
            </div>
            <div class='column' id='register'>
                <br><br><br>
                <a onclick='premium.html' class='none'>
                    <div class='hyperspan'>
                        <img src='pscyh2.jpeg'>
                        <h2>upgrade to premium</h2>
                        <p>premium members receive quality insight, unlimited practice quizzes, and numerous resources. compared to other ap psych resources, <b>sid's review</b> offers superior resources and opportunities to learn. click the button below to become a premium member.</p>
                        <button><a href='premium.html' class='none'>upgrade!</a></button><br><br>
                    </div><br><br><br><br><br><br><br>
                </a>
            </div>
        </div>";
   //second check     
} else if (mysqli_num_rows($result) > 0) {
    //if signed in correctly, set session_var "user" to the id of the user
    while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION["user"] = $row['id'];
    }
    //resulting display
    echo "
       <div id='header'>
            <h1>welcome!</h1>
        </div>
        
        <div class='row'>
            <div class='column' id='signin'>
                <br><br><br>
                <a onclick='test.php' class='none'>
                    <div class='hyperspan'>
                        <h2>free quiz! (basic account)</h2>
                        <p>click here to take your free quiz! this is only a *taste* of what premium members receive as a part of their membership. although we are sad that you aren't a member, here's a glimpse of what we offer at <b>sid's review</b> :))</p>
                        <button><a href='test.php' class='none'>take a quiz!</a></button><br><br>
                        <img src='psych1.jpg' height='367px'>
                    </div><br><br><br><br><br><br>
                </a>
            </div>
            <div class='column' id='register'>
                <br><br><br>
                <a onclick='premium.html' class='none'>
                    <div class='hyperspan'>
                        <img src='pscyh2.jpeg'>
                        <h2>upgrade to premium</h2>
                        <p>premium members receive quality insight, unlimited practice quizzes, and numerous resources. compared to other ap psych resources, <b>sid's review</b> offers superior resources and opportunities to learn. click the button below to become a premium member.</p>
                        <button><a href='premium.html' class='none'>upgrade!</a></button><br><br>
                    </div><br><br><br><br><br><br><br>
                </a>
            </div>
        </div>";
    //if the input fails to fit the two checks, then...
} else {
    //page showing that user input was incorrect
    echo "
        <div id='header'>
            <h1>uhhh...</h1>
        </div>
        
        <div id='info'>
            <h3>dear friend,,,</h3>
            <h5>your username or password was incorrect. please click the link below to try again.</h5>
            <a href='index.php' class='none'><h5>click here to return to the home page</h5></a>
        </div>
        ";
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
    <!--footer is the same for all three checks-->
    <div id="footer">
        <marquee behavior="scroll" direction="left"><b>NOTE: This is a quarter project for the Illinois Mathematics and Science Academy. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please do not take this seriously.</b></marquee>
    </div>

</body>

</html>