<!--Siddharth Tiwari, 11/23/30, register page

    quarter project register page.

    links to:
        index.php -> links back to homepage so that the user can signin again after registering/retrieving
  
    key features:
        registers user
            does not allow user to register if the same first name, last name, and email are entered
            does not allow user to register if the same username is entered
            allows user if input fits all cases
        allows user to reset their account if they've forgotten their password(addtional feature)
            
-->


<html>

<head>
    <title>sid's review</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php
    //include config file for connection
    include_once 'config.php';

    //select or create apData database
    if (mysqli_select_db($conn, 'apData')) {
    } else {
        if (mysqli_query($conn, "CREATE DATABASE apData")) {
        } else {
        }
    }

    //create or access "info" data table inside of apData database
    //structure of table:
        //firstname - contains first name of user
        //lastname - contains last name of user
        //user - contains username of user
        //pass - contains password of user
        //email - contains email of user
        //score - contains score of user (set to null at registration)
    $sql = "CREATE TABLE IF NOT EXISTS info (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                firstName VARCHAR(30) NOT NULL, 
                lastName VARCHAR(30) NOT NULL, 
                user VARCHAR(30) NOT NULL, 
                pass VARCHAR(30) NOT NULL, 
                email VARCHAR(30) NOT NULL,
                score int)";
    $result = mysqli_query($conn, $sql);

    //two cases (FROM HIDDEN FIELD 'sType' FROM INDEX.PHP)
    //register page will either register user or reset user information based on the form that was filled out
    switch ($_POST['sType']) {
        //if the user registers...
        case "r":
            //retrieve user inputs from registration form
            $fName = mysqli_real_escape_string($conn, $_POST['fName_r']);
            $lName = mysqli_real_escape_string($conn, $_POST['lName_r']);
            $email = mysqli_real_escape_string($conn, $_POST['email_r']);
            $username = mysqli_real_escape_string($conn, $_POST['username_r']);
            $password = md5(mysqli_real_escape_string($conn, $_POST['password_r'])); //encrypt password

            //2 checks:
                //check 1 --> duplicate registration (same first name, last name, and email inputted)
                //check 2 --> same username
            $sql = "SELECT * FROM info where firstName = '$fName' AND lastName = '$lName' AND email = '$email'";
            $result = mysqli_query($conn, $sql);
            $sql1 = "SELECT * FROM info where user = '$username'";
            $result1 = mysqli_query($conn, $sql1);

            //check 1
            if (mysqli_num_rows($result) > 0) {
                //tell user that they have already registered
                echo "
                        <div id='header'>
                            <h1>:0</h1>
                        </div>

                        <div id='info'>
                            <h3>dear $fName...</h3>
                            <h3>thats tough '-'</h3>
                            <h5>unfortunately, you have already signed up with an account. click the link below to return to the homepage.</h5>
                            <a href='index.php' class='none'><h5>click here to return to the home page</h5></a>
                        </div>";
            //check 2            
            } else if (mysqli_num_rows($result1) > 0) {
                //tell user that the username is already taken
                echo "
                        <div id='header'>
                            <h1>...</h1>
                        </div>

                        <div id='info'>
                            <h3>dear $fName,,,</h3>
                            <h3>*crickets*</h3>
                            <h5>unfortunately, someone has already taken your username. click the link below to register again.</h5>
                            <a href='index.php' class='none'><h5>click here to return to the home page</h5></a>
                        </div>";
            //if none of the checks are fulfilled, then the user can successfully register            
            } else {
                //insert data inside of the 'info' table
                $sql2 = "INSERT INTO info (firstName, lastName, user, pass, email, score) VALUES('$fName', '$lName', '$username', '$password', '$email', null)"; //put in null for score
                $result2 = mysqli_query($conn, $sql2);
                echo "
                        <div id='header'>
                            <h1>you're all set!</h1>
                        </div>

                        <div id='info'>
                            <h3>welcome, $fName!</h3>
                            <h3>your <b>sid's review</b> basic account has been set up!</h3>
                            <h5>although you have registered, you must go back to the home page to view your profile!</h5>
                            <a href='index.php' class='none'><h5>click here to return to the home page</h5></a>
                        </div>";
            }
            break;
        //retrieves information
        case "f":
            //get info 
            $fName = $_POST['fName_f'];
            $lName = $_POST['lName_f'];
            $email = $_POST['email_f'];

            //retrieve user account
            $sql = "SELECT * FROM info where firstName = '$fName' AND lastName = '$lName' AND email = '$email'";
            $result = mysqli_query($conn, $sql);

            //info is entered correctly
            if (mysqli_num_rows($result) > 0) {
                //deletes the record
                $sql1 = "DELETE FROM info WHERE firstName = '$fName' AND lastName = '$lName' AND email = '$email'";
                $result1 = mysqli_query($conn, $sql1);
                
                //tell user that account has been reset
                echo "
                        <div id='header'>
                            <h1>retrieve account</h1>
                        </div>

                        <div id='info'>
                            <h2>dear $fName,,</h2>
                            <h3>we've successfully reset your account!</h3>
                            <h4>click on the link below to go back to the homepage and reregister</h4>
                            <a href='index.php'><h5>click here to return to the home page</h5></a><br>
                        </div>";
            } else {
                //if info is entered correctly, display site telling user that we couldn't find their records
                echo "
                        <div id='header'>
                            <h1>:0</h1>
                        </div>

                        <div id='info'>
                            <h3>dear $fName...</h3>
                            <h3>thats tough '-'</h3>
                            <h5>unfortunately, we could not reset your account because you either:</h5>
                            <ul>
                                <li>did not complete all the fields when you registered</li>
                                <li>did not spell/fill out the fields correctly for the 'reset username/password' form</li>
                            </ul>
                            <h5>click the link below to return to the homepage and try again.</h5>
                            <a href='index.php' class='none'><h5>click here to return to the home page</h5></a>
                        </div>";
            }
            break;
        default:
    }
    ?>

    <div id="footer">
        <marquee behavior="scroll" direction="left"><b>NOTE: This is a quarter project for the Illinois Mathematics and Science Academy. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please do not take this seriously.</b></marquee>
    </div>

</body>

</html>