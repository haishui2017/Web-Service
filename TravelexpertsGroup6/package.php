<!--
|   Author:  Nour Srouji
|   Course:  CPRG210
|   Assignment:  ASSIGNMENT 1 - workshop 1
|   Languages:  Html - css - Javascript - php
|   Instructor: Harvey Peters
|   changes : 6-11-2017 Added the php part to extract data from database
-->
<?php
    session_start();  
    include("server/conn.php");
    // Create connection
    $conn = mysqli_connect($host, $user, $password, $dbname);
    // Check connection
    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    $_SESSION["currentpage"] = $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Travel Experts Inc.</title>
    <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet'>
    <link rel="stylesheet" href="css/nav_styles.css" />
    <link rel="stylesheet" href="css/packages_styles.css" />
    <link rel="stylesheet" href="css/main_styles.css" />
    <script type="text/javascript" src="scripts/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <div class="body-container">
    <div class="body-border">
        <!--navigation section added b: Kennard S.-->
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

    <div class="slideshow-container">
        <!-- php to extract data from data base for the slideshow -->
            <form method="post" action="bookingdetails.php">
            <?php

                $sql = "SELECT PackageId, PkgName, PkgStartDate, PkgEndDate, PkgDesc, PkgBasePrice, PkgImg FROM packages WHERE PkgEndDate>= now() ORDER BY PkgEndDate, PackageId LIMIT 4";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0)
                {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        $package_price = sprintf("$%-9.2f", $row["PkgBasePrice"]);
                        $startDate = date_create($row["PkgStartDate"]);
                        $endDate = date_create($row["PkgEndDate"]);
                        $dformat = "D M d, Y";
                        $date_now = new DateTime();
                        echo "<div class='mySlides fade'>
                                <div class='numbertext'>1 / 4</div>
                                <div class='container'>
                                    <img src='".$row["PkgImg"]."' style='width:100%; height:500px;'>
                                    <div class='clearbackground'>
                                    <div class='top-right'><br/><span style='font-size:30px ;font-family:Aldrich'>".$row["PkgName"]."</span><br/>Starts: ";
                        
                                    if($startDate < $date_now)
                                    {
                                      echo "<label style='color: red;font-weight: bold;'>".date_format($startDate, $dformat)."</label>";
                                    }
                                    else {
                                      echo " ".date_format($startDate, $dformat)."";
                                    }

                            
                            echo "<br/>Ends: ".date_format($endDate, $dformat)."<br/>Cost: $package_price CAD<p id='sale'></p><label id='salecountdown'></label>
                            <button value=".$row["PackageId"]." name='PackageId' class='button' id='top_buttons'>BOOK YOUR TRIP</button></div></div>
                                </div>
                                <br/><br/>
                                <div class='text'>".$row["PkgDesc"]."</div>
                            </div>";
                    }
                } 
                    else 
                {
                    echo "0 results";
                }

            ?>
            </form>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>

    <div class="dot-row" style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>

    <!-- php to extract data from data base for the columns-->
        <form method="post" action="bookingdetails.php">
    <?php

        $sql = "SELECT PackageId, PkgName, PkgStartDate, PkgEndDate, PkgDesc, PkgBasePrice, PkgImg FROM packages WHERE PkgEndDate>= now() ORDER BY PkgEndDate, PackageId LIMIT 4,3";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) 
            {
                $package_price = sprintf("$%-9.2f", $row["PkgBasePrice"]);
                $startDate = date_create($row["PkgStartDate"]);
                $endDate = date_create($row["PkgEndDate"]);
                $dformat = "D M d, Y";
                
                echo "<div class='columns'>
                <ul class='price'>
                <li class='header'>".$row["PkgName"]."</li>

                <li><img src='".$row["PkgImg"]."' style='width:100%'/></li>
                <li class='grey'>".$row["PkgDesc"]."<br/>
                <li>Cost: ".$package_price."</li>
                <li>Start Date: ".date_format($startDate, $dformat)."<br />End Date: ".date_format($endDate, $dformat)."</li>

                <li class='grey'><button value=".$row["PackageId"]." name='PackageId' class='button'>Book Now</button></li>
                </ul>
                </div>";
            }
        } 
        else 
        {
            echo "0 results";
        }
    ?>
        </form>
    <br/><br/><br/>
    <!-- php to extract data from data base-->
    <form method="post" action="bookingdetails.php">
        <?php

            $sql = "SELECT PackageId, PkgName, PkgStartDate, PkgEndDate, PkgDesc, PkgBasePrice, PkgImg FROM packages WHERE PkgEndDate>= now() ORDER BY PkgEndDate, PackageId LIMIT 7,3";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) 
            {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $package_price = sprintf("$%-9.2f", $row["PkgBasePrice"]);
                    $startDate = date_create($row["PkgStartDate"]);
                    $endDate = date_create($row["PkgEndDate"]);
                    $dformat = "D M d, Y";
                    echo "<div class='columns'>
                    <ul class='price'>
                    <li class='header'>".$row["PkgName"]."</li>
                    <li><img src='".$row["PkgImg"]."' style='width:100%'/></li>
                    <li class='grey'>".$row["PkgDesc"]."<br/>
                    <li >".$package_price."<br/></li>
                    <li>Start Date: ".date_format($startDate, $dformat)."<br />End Date: ".date_format($endDate, $dformat)."</li>

                    <li class='grey'><button value=".$row["PackageId"]." name='PackageId' class='button'>Book Now</button></li>
                    </ul>
                    </div>";
                }
            } 
            else 
            {
                echo "0 results";
            }
            mysqli_close($conn);
        ?>
    </form>

        <!--script for the slide show-->
        <script type="text/javascript" src="scripts/packages_script.js"></script>
        <?php
            include("footer.php");  
        ?>
        </div>
    </div>

    </body>
</html>
