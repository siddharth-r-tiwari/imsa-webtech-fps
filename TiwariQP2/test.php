<!--Siddharth Tiwari, 11/23/30, test page

    quarter project test page.
  
    key features:
        includes code from the "questions.sql" file to populate "questions" table
        retrieves 5 random questions from the "questions" table

            
-->

<html>

<head>
    <title>sid's review</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css?v=<?php echo time(); ?>">
</head>

<body>
    <div id="header">
        <h1>quiz!</h1>
    </div>

    <?php
    //connect using config file
    include_once 'config.php';

    //select db
    if (mysqli_select_db($conn, 'apData')) {
    } else {
        if (mysqli_query($conn, "CREATE DATABASE apData")) {
        } else {
        }
        mysqli_select_db($conn, "apData");
    }

    //run the queries from the questions.sql file
    $sql = file_get_contents('questions.sql');

    //since this file contains multiple queries, this chunk of code must be used
    if (mysqli_multi_query($conn, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result)) {
                }
                mysqli_free_result($result);
            }
            // if there are more result-sets, the print a divider
            if (mysqli_more_results($conn)) {
            }
            //Prepare next result set
        } while (mysqli_next_result($conn));
    }

    //select 5 random questions from Questions table
    $sql = "SELECT * FROM Questions
            ORDER BY RAND()
            LIMIT 5";

    $result = mysqli_query($conn, $sql);

    
    //counter var to set question id and display question number
    $i = 1;

    //if 5 random questions are selected successfully...
    if (mysqli_num_rows($result) > 0) {
        //create quiz
        echo "<form id='quiz' action='result.php' method='post'>";
        //use results of query to display questions
        while ($row = mysqli_fetch_assoc($result)) {
            //question details:
                //use var i to display question number and info from 'question' column in "Questions" table
                //create a group of radio buttons using info from 'op_1', 'op_2', 'op_3', and 'op_4' to display options
                    //each option is assigned a corresponding value based on it's position (1, 2, 3, or 4)
                //the name of the radio group is set to the var i
                //a hidden input field also is created with each radio group, containing the corresponding 'qID' for the current question in the 'Questions' table
            echo "
                    <p>question $i:  " .  $row['question'] . "</p>
                    <input type='radio' name='$i' value='1' required>" . $row['op_1'] . "<br>
                    <input type='radio' name='$i' value='2'>" . $row['op_2'] . "<br>
                    <input type='radio' name='$i' value='3'>" . $row['op_3'] . "<br>
                    <input type='radio' name='$i' value='4'>" . $row['op_4'] . "<br><br>
                    <input type='hidden' name='Q" . $i . "' value='" . $row['qID'] . "'>
                    ";
            //increase increment
            $i++;
        }
        echo "
                <input type='submit' style='text-align:center'>
                </form>";
    } else {
        //no results, then 0 results printed
        echo "<p>0 results</p>";
    }

    ?>

    <div id="footer">
        <marquee behavior="scroll" direction="left"><b>NOTE: This is a quarter project for the Illinois Mathematics and Science Academy. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Please do not take this seriously.</b></marquee>
    </div>

</body>

</html>