<!--Author: Farshad and Kennard-->
<!--Course: CPRG210-->
<!--Created: Nov 6th, 2017-->

<?php
    date_default_timezone_set('Canada/Mountain');
    session_start();  
    $_SESSION["currentpage"] = $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts Inc.</title>
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
        <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css" />
        <link rel="stylesheet" href="css/nav_styles.css" />
        <link rel="stylesheet" href="css/main_styles.css" />
        <script type="text/javascript" src="scripts/scripts.js"></script>
    </head>
    <body>
        <div class="body-container">
            <div class="body-border">
                <!--navigation section-->
                <?php
                    include("navigation.php"); 
                    if (isset($_SESSION["loggedin"]))
                    {
                        $user_status = "Logout";
                        $go_to = "logout.php";
                    }	
                    else
                    {
                        $user_status = "Login";
                        $go_to = "login.php";
                    }
                ?>
                <div class="parallax-index-1" id="parallax">
                    <div class="welcome">
                        <div id="welcome-container" class="w3-container w3-center w3-animate-zoom">
                        <label id="welcome-company">Travel Experts</label>
                        <label id="tagline" class="welcome-tag-line"></label>
                        </div>
                    </div>
                </div>
                <!--created by Kennard S. -->
                <script type="text/javascript">

                    //this section gets the characters in in the array and displays them like a typewriter
                    // set up text to print, each item in array is new line
                    var tagArray = new Array("Creating","Unforgettable","Memories");
                    var speed = 200; // time delay of print out
                    var index = 0; // start printing array at this posision
                    var iArrLength = tagArray[0].length; // the length of the text array
                    var iScrollAt = 20; // start scrolling up at this many lines
                    var iTextPos = 0; // initialise text position
                    var sContents = ''; // initialise contents variable
                    var iRow; // initialise current row

                    function typewriter()
                    {
                        sContents =  ' ';
                        iRow = Math.max(0, index-iScrollAt);
                        var destination = document.getElementById("tagline");

                        while ( iRow < index ) 
                        {
                            sContents += tagArray[iRow++] + '<br />';
                        }
                        destination.innerHTML = sContents + tagArray[index].substring(0, iTextPos) + "_";
                        if ( iTextPos++ == iArrLength ) 
                        {
                            iTextPos = 0;
                            index++;
                            if ( index != tagArray.length ) 
                            {
                                iArrLength = tagArray[index].length;
                                setTimeout("typewriter()", 500);
                            }
                        } 
                        else 
                        {
                            setTimeout("typewriter()", speed);
                        }
                    }
                    
                    typewriter();

                </script>
                
            </div>
        </div>
    </body>
</html>
