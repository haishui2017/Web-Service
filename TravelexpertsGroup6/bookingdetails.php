<!--Authors: Nour and Kennard-->
<!--Created: Nov 6th, 2017-->

<?php
    include("server/conn.php");
    session_start();  

    if (isset($_REQUEST['PackageId'])) 
    {
        $_SESSION["PackageId"] = $_REQUEST["PackageId"];
    }

	if (!isset($_SESSION["loggedin"]))
	{
		$_SESSION["currentpage"] = $_SERVER["PHP_SELF"];
		header("Location: login.php");
	}

    if (!isset($_SESSION["PackageId"]))
    {
		header("Location: package.php");
    }
    $P_ID = $_SESSION["PackageId"];

    $db_conn = mysqli_connect($host, $user, $password, $dbname);
    if (!$db_conn)
    {
        print(mysqli_connect_error() ."<br />");
        exit();
    }

    if ($result = mysqli_query($db_conn, "SELECT * FROM packages WHERE PackageId='$P_ID'"))
    {
        while ($row = mysqli_fetch_row($result))
        {
            $PkgName = $row[1];
            $PkgStartDate = $row[2];
            $PkgEndDate = $row[3];
            $PkgDesc = $row[4];
            $PkgBasePrice = $row[5];
            $PkgImg = $row[7];
        }
    }  
    mysqli_close($db_conn);
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
        <script>            
            
        </script>
	</head>
	<body style="margin: 0px;">
        <div class="body-container">
            <div class="body-border" >
                
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
                    $dformat = "D M d, Y"
                ?>
                <p>

                </p>
                <form method="post" action="confirmation.php">  <!-- add action to book the vacation package selected-->
                    <div class="bookingcontainer">
                        <div class="booking-col">
                            <h2 style="text-align: center;">Booking Order Form</h2><br />
                            <h3>Selected Package</h3><label type="text" name="PkgName"><?php print($PkgName); ?></label>
                            <img id="package-img" class="package-img" src="<?php print($PkgImg);?>" />
                            <h3>Cost</h3>
                            <label type="text" name="BasePrice">
                            <?php 
                                printf("$ %-9.2f", ((float)$PkgBasePrice));
                            ?> 
                            </label> CAD
                            <br />
                            <h3>Includes</h3><label type="text" name="PkgDesc" ><?php print($PkgDesc); ?></label><br /><br /><br />
                            <hr><br /><br />
                            Trip Type: <br /> 
                                <select id="TripTypeId" name="TripTypeId">
                                    <option value=""></option>	
                                        <?php
                                            $db_conn = mysqli_connect($host, $user, $password, $dbname);
                                            if (!$db_conn)
                                            {
                                                print(mysqli_connect_error() ."<br />");
                                                exit();
                                            }

                                            if ($result = mysqli_query($db_conn, "SELECT * FROM triptypes"))
                                            {
                                                while ($row = mysqli_fetch_row($result))
                                                {
                                                    print("<option value='$row[0]'>$row[1]</option>");
                                                }
                                            }
                                        ?>
                                </select><br />
                            # of Travellers: <br /> <input type="number" value="1" min="1" max="5" name="TravelerCount" /><br />
                            Departure City: <br /> 
                                <select id="DepartureCity" name="DepartureCity">
                                    <option value=""></option>	
                                        <?php
                                            $db_conn = mysqli_connect($host, $user, $password, $dbname);
                                            if (!$db_conn)
                                            {
                                                print(mysqli_connect_error() ."<br />");
                                                exit();
                                            }

                                            if ($result = mysqli_query($db_conn, "SELECT city FROM cities"))
                                            {
                                                while ($row = mysqli_fetch_row($result))
                                                {
                                                    print("<option value='$row[0]'>$row[0]</option>");
                                                }
                                            }
                                        ?>
                                </select>  <br /><br />
                           <h3>Payment Information</h3>

                            <div id="new_card_div" class="new_card_div">
                                <label>Please select a payment type</label>
                                <div class="card_images_container">
                                    <br/>
                                    <img onclick="styleCardType(this, 0)" name="cardtype" id="amex" value="AMEX" src="media/icons/amex.png"/>
                                    <img onclick="styleCardType(this, 1)" name="cardtype" id="dc" value="Diners" src="media/icons/diners_club.png" />
                                    <img onclick="styleCardType(this, 2)" name="cardtype" id="discover" value="Discover" src="media/icons/discover.png" />
                                    <img onclick="styleCardType(this, 3)" name="cardtype" id="mc" value="Mastercard" src="media/icons/mastercard.png" />
                                    <img onclick="styleCardType(this, 4)" name="cardtype" id="visa" value="Visa" src="media/icons/visa.png" />
                                </div>
                                <br />
                                * Card Type: <br /> 
                                    <select onchange="" id="CCName" name="CCName">
                                        <option value="">Select card type</option>	
                                        <option value="AMEX">American Express</option>	
                                        <option value="Visa">Visa</option>	
                                        <option value="Diners">Diners Club</option>	
                                        <option value="Discover">Discover</option>	
                                        <option value="Mastercard">Master Card</option>	
                                    </select><br />
                                * Card number:<br /> <input type="text" maxlength="16" name="CCNumber" /><br />
                                * Card Expiry: <br /> 
                                    <input type="date" name="CCExpiry" min="2017-11-17"/>
                                <br />
                                <br />
                            </div>
                            <br />
                            <br />
                            <div class="bookingBtns">
                                <input type="submit" onclick="return checkForm(this.form)" value="Continue" class="continue_button" /><span></span>
                                <input type="reset" value="Reset" class="reset_button" onclick="return clearForm()" />
                                <input type="button" value="Back" class="back_button" onclick="javascript:window.location.href = 'package.php'" />
                            </div>
                        </div>
                        <!-- this section below is for payment information -->
                    </div>
                </form>
                <?php
                    include("footer.php");
                ?>
            </div>
        </div>
	</body>
</html>