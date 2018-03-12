<!--Author: Farshad and Nour-->
<!--Course: CPRG210-->
<!--Created: November 11, 2017-->
<?php
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
    <style>


    </style>
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

                <div id="parallax-about" class="parallax-about">
                    <div class="about-title">About us</div>
                    <div class="about-container">
                    <div class="tab">
                        <button class="tablinks active" onclick="openTab(event, 'us')">Our Agency</button>
                        <button class="tablinks" onclick="openTab(event, 'mission')">Our Mission</button>
                        <button class="tablinks" onclick="openTab(event, 'values')">Our Values</button>
                    </div>

                    <div style="display: block;" id="us" class="tabcontent active">
                        <p>The Travel Experts agency is a Canadian owned and operated agency located in Calgary, Alberta, as well as a branch office in Okotoks just outside of the Calgary city limits.</p>
                    </div>

                    <div id="mission" class="tabcontent">
                        <p>As an independent agency, we strive to provide our clients a unique approach to travelling. Whether it is for business, or for leisure, our agents and online platform will guide you to your next destination in just a few clicks!</p>
                    </div>

                    <div id="values" class="tabcontent">
                    <ul>
                        <li>Commitment to safety.</li>
                        <li>Value our client's needs and requests.</li>
                        <li>Fun, friendly and caring environment.</li>
                        <li>Honest, open and keep our commitments!</li>
                    </ul>
                    </div>
                </div>
            </div>

        <script>
        function openTab(evt, cityName) 
        {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) 
            {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) 
            {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        </script>
                                <!-- this is the footer section       -->
            <?php
            include("footer.php");  
            ?>
        </div>
    </div>
</body>
</html>
