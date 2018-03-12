<!--Author: Nour and Kennard-->
<!--Created: Nov 6th, 2017-->

<?php
    date_default_timezone_set('Canada/Mountain');
    include("server/conn.php");
    session_start();  
    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (!isset($_SESSION["PackageId"]))
    {
        header("location: package.php");
    }
    $P_ID = $_SESSION["PackageId"];
    
    if (isset($_REQUEST["TripTypeId"]))
    {
        $Trip_ID = $_REQUEST["TripTypeId"];
        $TravelerCount = $_REQUEST["TravelerCount"];
        if (!isset($_REQUEST["CCName"]))
        {
            $PaymentType = "Existing Card";
        }
    }
    else
    {
        header("location: bookingdetails.php");
    }

    if (isset($_REQUEST["CCNumber"]) and ($_REQUEST["CCNumber"] != ""))
    {
        $PaymentType = $_REQUEST["CCName"];
        $_SESSION["CCName"] = $_REQUEST["CCName"];
        $_SESSION["CCNumber"] = $_REQUEST["CCNumber"];
        $_SESSION["CCExpiry"] = $_REQUEST["CCExpiry"];

    }
    else
    {
        $PaymentType = "Existing Card";
    }
    
    $dformat = "D M d, Y";

    if ($result = mysqli_query($conn, "SELECT * FROM packages WHERE PackageId='$P_ID'"))
    {
        while ($row = mysqli_fetch_row($result))
        {
            $PkgName = $row[1];
            $PkgStartDate = date_create($row[2]);
            $PkgStartDate = date_format($PkgStartDate, $dformat);           
            $PkgEndDate = date_create($row[3]);
            $PkgEndDate = date_format($PkgEndDate, $dformat);
            $PkgDesc = $row[4];
            $PkgBasePrice = sprintf("%-9.2f", $row[5]);
        }
    } 
    if ($result = mysqli_query($conn, "SELECT * FROM triptypes WHERE TripTypeId='$Trip_ID'"))
    {
        while ($row = mysqli_fetch_row($result))
        {
            $TTName = $row[1];
        }
    }  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Travel Experts Inc.</title>
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
        <link rel="stylesheet" href="css/nav_styles.css" />
        <link rel="stylesheet" href="css/main_styles.css" />
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <script>
            
        </script>
        <style>
* 
{
    box-sizing: border-box;
}
.confirm-container
{
    width: 100%;
    min-height: 500px;
    height: auto;
    position: relative;
    margin-bottom: 300px;
    margin-top: 30px;
}
.columns 
{
    width: 80%; /*can be in percentage also.*/
    height: auto;
    margin: 0 auto;
    padding: 30px;
    position: relative;
    box-shadow: 0 4px 8px 4px rgba(0, 0, 0, 0.2);
    background-color: #1a3749;
}

.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
    background-color: white;
}

.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
    background-color: #10222d;
    color: white;
    font-size: 25px;
}

.price li {
    border-bottom: 1px solid #eee;
    padding: 20px;
    text-align: center;
}

.price .grey {
    background-color: #eee;
    font-size: 20px;
}

.button 
{
    background-color: #10222d;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
}
.button:hover
{
    background-color: #039be5;
}
.button span 
{
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
@media only screen and (max-width: 600px) {
    .columns 
    {
        width: 100%;
    }
}
        </style>
    </head>
    <body style="margin: 0px;">
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

                <!--main section-->
                <div class="confirm-container">
                    <form method="post" action="php/checkrequests.php">
                <?php

                    $GST = 0.05;
                    $sub = sprintf("%-9.2f", ((float)$PkgBasePrice * (float)$TravelerCount));
                    $tax = sprintf("%-9.2f", ((float)$sub * $GST));
                    $total= sprintf("%-9.2f", ((float)$sub + (float)$tax));
                    
                    $_SESSION["TravelerCount"] = $TravelerCount;
                    $_SESSION["DepartureCity"] = $_REQUEST['DepartureCity'];
                    $_SESSION["TripTypeId"] = $Trip_ID;

                    echo "<div class='columns'>
                      <ul class='price'>
                        <li class='header'>Package Checkout</li>
                        <li class='grey' name='PkgName' value='$PkgName'>Name: ".$PkgName."</li>
                        <li name='PkgDesc' value='$PkgDesc'>Includes: ".$PkgDesc." </li>
                        <li name='TripTypeId' value='$Trip_ID'>Trip Type: ".$TTName."</li>
                        <li>Payment Method: ".$PaymentType."</li>
                        <li name='TravelerCount' value='$TravelerCount'>Number of travellers: ".$TravelerCount."</li>
                        <li name='DepartureCity'>Departing From: ".$_REQUEST['DepartureCity']."</li>
                        <li><b>Pricing Summary</b><br /> $TravelerCount x \$$PkgBasePrice </b><br/><br/>Taxes and fees <br/> $". $tax." <br/><br/>Total:<br/> <b>$".$total."</b> CAD</li>
                        
                        <li class='grey'><a href='javascript:history.back()' style='float: left;' class='button'>Back</a><button style='margin-right: 0%;' class='button' onclick='return confirmBooking()'><span>Complete Transaction</span></button></li>
                      </ul>
                    </div>";
                    ?>
                </form>
                </div>
                
                <?php
                    include("footer.php");  
                ?>
            </div>
        </div>
    </body>
</html>
