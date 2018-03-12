<!--Author: Kennard Stewart-->
<!--Course: CPRG210-->
<!--Created: Nov 14th, 2017-->

<?php
    session_start();  

    if (!isset($_SESSION['PackageId'])) 
    {
        header("Location: package.php");
    }
    if (isset($_SESSION["bookingmessage"]))
	{
		$message = $_SESSION["bookingmessage"];
		unset($_SESSION["bookingmessage"]);
		unset($_SESSION["PackageId"]);
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Travel Experts Inc.</title>
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
        <link rel="stylesheet" href="css/nav_styles.css" />
        <link rel="stylesheet" href="css/main_styles.css" />
        <link rel="stylesheet" href="css/form_styles.css" />
        <script type="text/javascript" src="scripts/scripts.js"></script>

	</head>
	<body style="overflow-x: hidden">
        <div class="body-container">
            <div class="body-border">
                
                <?php
                    include("navigation.php"); 
                    if (isset($_SESSION["loggedin"]) and ($_SESSION["loggedin"]))
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
                <div class="refnum-container" style="text-align: center;width: 100%; height: 500px; padding: 30px;">
                    <h2 style="width: 100%;">
                        <?php
                            
                            print($message);
                            print("<br/>");
                        ?>
                    </h2>
                    <?php
                        print("<br/>");
                        if (isset($_SESSION["BookingNo"]))
                        {                            
                            print("<h3>Booking Reference Number: </h3><br/>");
                            print("<h2 style='width: 100%; color: red;'>".$_SESSION["BookingNo"]."</h2>");

                        }
                    ?>
                    <br/>
                    <br/>
                    <label style="width: 100%; height: 50px;">Thank you for using booking with <b>Travel Experts!</b></label>
                </div>

                <?php
                    include("footer.php");
                ?>
            </div>
        </div>
	</body>
</html>