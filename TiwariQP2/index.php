<!--Siddharth Tiwari, 11/23/30, Homepage

    quarter project homepage.

    links to:
        profile.php -> for signing in
        register.php -> for registering and retrieving email
  
    key features:
        links to other pages
        modal box display
-->

<!DOCTYPE html>

<html>

<head>
    <title>sid's review</title>
    <link rel="shortcut icon" href="icon.png">
    <link rel="stylesheet" href="base.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <script src="functions.js"></script>
</head>

<body>
    <!--header of the page-->
    <div id="header">
        <h1>sid's ap psychology review</h1>
        <div class="row">
            <div class="column">
                <img src="brain.png">
            </div>
            <div class="column">
                <p><i>"the best ap psychology study resource to ever exist"</i> - dr. sigmund freud, renowned psychologist</p>
                <p><i>"the website is almost as beautiful as all the knowledge on this website"</i> - mr. thomas meyer, overpaid computer science instructor at the illinois mathematics and science academy</p>
            </div>
        </div>
    </div>

    <!--filler section (only to make the website look real)-->
    <div id="info">
        <h2>why study with sid?</h2>
        <div class="row">
            <div class="column">
                <h3>sid's ap psychology review offers:</h3>
                <ul style="list-style-position:inside; text-align:left;">
                    <li>unlimited practice quizzes</li>
                    <li>100+ hours of *delicious* videos on chapters 1 through 9</li>
                    <li>50+ practice frqs</li>
                    <li>on-call, verified psychology tutors</li>
                    <li>peace, love and good vibes B)</li>
                </ul>
            </div>
            <div class="column">
                <img src="classroom.jpg" height=400>
            </div>
        </div><br><br>
    </div>

    <!--row containing login and register links-->
    <div class="row">
        <div class="column" id="signin">
            <!--I added a feature where if the user clicks on the div/section, then an action/link is performed-->
            <a onclick="showModal('signinForm')" class="none">
                <div class="hyperspan">
                    <h2>login</h2>
                    <p>Login into your account to take practice quizzes! Sign in here if you already have an account!</p>
                    <button onclick="showModal('signinForm')">sign in!</button><!--show signin modal-->
                </div>
                <br>
            </a>
        </div>
        <div class="column" id="register">
            <a onclick="showModal('registerForm')" class="none">
                <div class="hyperspan">
                    <h2>register</h2>
                    <p>If you have not created a <b>sid's review</b> account yet, create one here! With a premium membership, you will be able to take multiple practice quizzes!</p>
                    <button onclick="showModal('registerForm')">register!</button><!--show register modal-->
                </div>
            </a>
        </div>
    </div>


    <!--modal containing signin form-->
    <div id="signinForm" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="b">
                <button onclick="closeModal('signinForm')" style="float: right"><span class="close">&times;</span></button>
                <h1>sign-in</h1>
            </div>

            <!--form for registration-->
            <div class="modal-body" id="b">
                <p>enter your username and password!</p>
                <form action="profile.php" method="post" name="SI">
                    username:
                    <input type="text" name="username_SI" required><br><br>
 
                    password:
                    <input type="password" name="password_SI" required><br><br>

                    <!--hidden field 'sType' is used -->
                    <input type="hidden" name="sType" value="SI">
                    <input type="submit">
                </form>
            </div>


            <div class="modal-footer" id="b"><br><br>
                <a onclick="closeModal('signinForm'); showModal('forgotForm');">click here if you forgot your username or password!</a><br><br>
            </div>
        </div>
    </div>


    <!--modal containing register form-->
    <div id="registerForm" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="c">
                <button onclick="closeModal('registerForm')" style="float: right"><span class="close">&times;</span></button>
                <h2>register</h2>
            </div>

            <div class="modal-body" id="c">

                <p>enter your personal information to register!</p>

                <!--form for registration-->
                <form action="register.php" method="post" name="r">

                    first name:
                    <input type="text" name="fName_r" required><br><br>

                    last name:
                    <input type="text" name="lName_r" required><br><br>

                    email:
                    <input type="email" name="email_r" required><br><br>

                    username:
                    <input type="text" name="username_r" required><br><br>

                    password:
                    <input type="password" name="password_r" required><br><br>

                    <input type="hidden" name="sType" value="r">

                    <input type="submit" name="submit_r">
                </form>
            </div>


            <div class="modal-footer" id="c"><br>

            </div>
        </div>
    </div>


    <!--modal containing forgot form-->
    <div id="forgotForm" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="d">
                <button onclick="closeModal('forgotForm')" style="float: right"><span class="close">&times;</span></button>
                <h2>reset account</h2>
            </div>

            <div class="modal-body" id="d">

                <p>enter your name and email to reset your account!</p>

                <!--form for forgot information-->
                <form action="register.php" method="post" name="f">
                    first name:
                    <input type="text" name="fName_f" required><br><br>

                    last name:
                    <input type="text" name="lName_f" required><br><br>

                    email:
                    <input type="email" name="email_f" required><br><br>

                    <input type="hidden" name="sType" value="f">

                    <input type="submit" name="submit_f">
                </form>
            </div>


            <div class="modal-footer" id="d"><br>

            </div>
        </div>
    </div>

    <!--footer section-->
    <div id="footer">
        <marquee behavior="scroll" direction="left"><b>NOTE: This is a quarter project for the Illinois Mathematics and Science Academy. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please do not take this seriously.</b></marquee>
    </div>

</body>

</html>