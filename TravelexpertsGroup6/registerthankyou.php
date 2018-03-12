<!--Author: Kennard Stewart-->
<!--Course: CPRG210-->
<!--Created: Nov 6th, 2017-->

<?php
    session_start();  

    if (!isset($_SESSION["registered"]))
	{
		header("location: register.php");
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
                ?>
                <div style="text-align: center;width: 100%; height: 500px; padding: 30px;">
                    <h1 style="width: 100%;">
                        <?php 
                        
                            if (isset($_SESSION["message"]))
                            {
                                print($_SESSION["message"]);
                                unset($_SESSION["message"]);
                                unset($_SESSION["registered"]);
                            }
                        ?>
                    </h1>
                </div>

                <?php
                    include("footer.php");
                ?>
            </div>
        </div>
	</body>
</html>