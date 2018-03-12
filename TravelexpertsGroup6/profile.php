<!--Author: Kennard Stewart-->
<!--Course: CPRG210-->
<!--Created: Nov 15th, 2017-->
<?php
    include("server/conn.php");
    session_start();

    if(isset($_SESSION["message"]))
    {
        $message = $_SESSION["message"];
        $_SESSION["message"] = "";
        unset($_SESSION["message"]);
    }

    if (!isset($_SESSION["loggedin"]))
    {
        header("location: login.php");
    }	

    $conn = mysqli_connect($host, $user, $password, $dbname);

    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    if (isset($_SESSION["CustomerId"]))
    {
        $custid = $_SESSION["CustomerId"];
        if ($result = mysqli_query($conn, "SELECT * FROM customers WHERE CustomerId='$custid'"))
        {
            while ($row = mysqli_fetch_row($result))
            {
                $fname = strtoupper($row[1]);
                $lname = strtoupper($row[2]);
                $address = strtoupper($row[3]);
                $city = strtoupper($row[4]);
                $province = $row[5];
                $code = strtoupper($row[6]);
                $country = strtoupper($row[7]);
                $hphone = $row[8];
                $bphone = $row[9];
                $email = $row[10];
                $uname = $row[12];
            }
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
        <link rel="stylesheet" href="css/nav_styles.css" />
        <link rel="stylesheet" href="css/form_styles.css" />
        <link rel="stylesheet" href="css/main_styles.css" />
        <script type="text/javascript" src="scripts/scripts.js"></script>
    </head>
    <body>
        <div class="body-container">
            <div class="body-border" id="profile-body" >
                <?php
                    include("navigation.php");
                ?>
                <div class="profile-container">
                    <h1>Profile</h1>
                    <form method="post" action="">
                        <div class="profile-inputs">
                            <input type="text" name="CustUserName" disabled value="<?php print($uname);?>"/>
                            <input type="text" id="firstname" placeholder="First Name" name="CustFirstName" value="<?php print($fname);?>"/>
                            <input type="text" id="lastname" placeholder="Last Name" name="CustLastName" value="<?php print($lname);?>"/>
                            <input type="text" placeholder="Email Address" name="CustEmail" value="<?php print($email);?>"/>
                            <input type="text" id="homephone" placeholder="Home Phone" name="CustHomePhone" value="<?php print($hphone);?>"/>
                            <input type="text" id="busphone" placeholder="Work Phone" name="CustBusPhone" value="<?php print($bphone);?>"/>
                            <input type="text" placeholder="Mailing Address" name="CustAddress" value="<?php print($address);?>"/>
                            <input type="text" id="myprov" placeholder="Province" name="CustProv" value="<?php print($province);?>"/>
                            <input type="text" id="mycity" placeholder="City" name="CustCity" value="<?php print($city);?>"/>
                            <input type="text" id="mypostal" placeholder="Postal Code/Zip" name="CustPostal" value="<?php print($code);?>"/>
                            <input type="text" id="mycountry" placeholder="Country" name="CustCountry" value="<?php print($country);?>"/>
                        </div>

                        <div class="cancel-container">
                            <button type="submit" class="updateBtn"><span>Update</span></button>
                        </div>
                    </form>
                </div>
                <?php
                    include("footer.php");  
                ?>
            </div>
        </div>
    </body>
</html>
