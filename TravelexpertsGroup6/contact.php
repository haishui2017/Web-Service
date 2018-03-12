<!-- Contact page 
Author: Cecilia(Wenxi) Zhang 
Course: CPRG210
-->

<?php
    session_start();
    include "server/conn.php";
    $dbh = mysqli_connect($host,$user,$password,$dbname);
	if(!$dbh)
	{
		print(mysqli_connect_error(). "<br/>");
		exit();
	}
    $_SESSION["currentpage"] = $_SERVER["PHP_SELF"];

    $photo[]="media/images/agent1.jpg";
    $photo[]="media/images/agent2.jpg";
    $photo[]="media/images/agent3.jpg";
    $photo[]="media/images/agent4.jpg";
    $photo[]="media/images/agent5.jpg";
    $photo[]="media/images/agent6.jpg";
    $photo[]="media/images/agent8.jpg";
    $photo[]="media/images/agent7.jpg";
    $photo[]="media/images/agent9.jpg";
    $photo[]="media/images/agent11.jpg";
    $photo[]="media/images/agent10.jpg";
    $photo[]="media/images/agent12.jpg";
    $photo[]="media/images/agent13.jpg";

    $i=0;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Contact</title>
    <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">    
    <link rel="stylesheet" href="css/nav_styles.css" />
    <link rel="stylesheet" href="css/main_styles.css" />
    <link rel="stylesheet" type="text/css" href="css/contact_style.css">   
    <script type="text/javascript" src="scripts/scripts.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOFSKu1Rk74xhyE-ldsjXBmuSj-2-WbXY"></script> 
	<script src="scripts/smooth.js"></script>
</head>
<body onscroll="stickynav()" style="margin: 0px;">
    <div class="body-container"> <!--Added by kennard    -->
        <div class="body-border"> <!--Added by kennard    -->
            <?php
                include("navigation.php"); //<!--Added by kennard    -->
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
        <div class="parallax1">
            <label>Contact Us</label>
        </div>

	<div class="floating-menu" id="navbar" style="visibility: hidden">
    <!-- <h3>Quick Jump</h3> -->
    <a href="#top">|Top|</a><br/>
    <a href="#maincontact">|Main|</a><br/>    
    <a href="#location">|Locations|</a><br/>    
    <a href="#agents">|Agents|</a><br/>
 	 </div>

<div id="maincontact" class="col-container">

	<div class="halfcol">
		<div class="maintext">
			<h1 style="color:#1a3749;"><b>Travel Experts</b></h1>

			<p>The travel agents at Travel Experts provide personalized service and advice that lives up to your expectations.</p>
	    </div>
	    <div class="socialmedia">
			<h4 style="color:#1a3749;">Follow Us</h4>
			<a href="https://www.facebook.com/" target="_blank" class="fa fa-facebook"></a>
			<a href="https://twitter.com/" target="_blank" class="fa fa-twitter"></a>
			<a href="https://plus.google.com/u/0/discover" target="_blank"  class="fa fa-google"></a>
			<a href="https://www.youtube.com/" target="_blank" class="fa fa-youtube"></a>
		</div>   
	</div>

    <div class="halfcol"> 
    	<div class="sagents"> 
    		<h2 style="border-bottom: 3px solid #1a3749;color:#1a3749;"><b>Senior Agents</b></h2>     			

<?php 
	$sql= "SELECT AgtEmail,AgtBusPhone,AgtLastName,AgtMiddleInitial,AgtFirstName FROM agents WHERE AgtPosition='Senior Agent'";
	if($result = mysqli_query($dbh,$sql))
	{
		while($row = mysqli_fetch_row($result))
		{
		print("<h4>$row[4] $row[3] $row[2]</h4>
				<p>Phone: $row[1]<br/>Email: $row[0]</p>");
		}	
	}

?>
	    
		</div>
	</div>
</div>

	<div class="parallax2"></div>

<div id="location" class="col-container">
	<div class="halfcol">
		<div class="locations">
		<h2 style="border-bottom: 3px solid #1a3749;color:#1a3749;"><b>Locations</b></h2>  			
<?php 
	$sql= "SELECT AgncyAddress,AgncyCity,AgncyProv,AgncyPostal,AgncyCountry,AgncyPhone,AgncyFax FROM agencies";
	if($result = mysqli_query($dbh,$sql))
	{
		while($row = mysqli_fetch_row($result))
		{
		print("<h3 class='fa fa-map-marker' style='margin-bottom:2px;'><b>$row[1]</b></h3>
				<p>$row[0]$row[1], $row[2]$row[3], $row[4]<br/>Phone: $row[5]<br/>
					Fax: $row[6]</p>");
		}	
	}
?>	
	
		</div>
	</div>
	<div class="halfcol">
		<div class="googlemap">
		<h2 style="margin-bottom: 20px;color:#1a3749;"><b>Check on Map</b></h2>
		<div id="map_div"></div>
		<script src="scripts/googlemap.js"></script>
		</div>
	</div>
</div>


	<div class="parallax3"></div>

<div id="agents">
	
	<div class="agentlist">
	<h2 style="border-bottom: 3px solid #1a3749;color:#1a3749;"><b>Agents</b></h2>
	<h3 style="color:#1a3749;">Calgary Office:</h3>
<?php 
 
	$sql= "SELECT AgtFirstName,AgtMiddleInitial,AgtLastName,AgtBusPhone,AgtEmail,AgtPosition FROM agents WHERE AgencyId =1 ";
	if($result = mysqli_query($dbh,$sql))
	{
		while($row = mysqli_fetch_row($result))
		{
		print("<div class='acol'>
			<div class='card'>
			  <img src='$photo[$i]' alt='Avatar' class='image'>
			  <div class='middle'>
			  		<p> Email:$row[4]</p>
			  		<p> Phone:$row[3] </p>
    				<div class='text'>
    				<a href='mailto:$row[4]' target='_top' style=' text-decoration:none;'>Send Email</a>
    				</div>
  			  </div>
			  <div class='container'>
			    <p><b>$row[0] $row[1] $row[2]</b></p> 
			    <i>$row[5]</i> 			    
			  </div>
			</div>
	    </div>");
	    $i++;
		}	
	}
?>
	</div>
	
	<div class="agentlist">
	<h3 style="color:#1a3749;">Okotoks Office:</h3>
<?php
	$sql= "SELECT AgtFirstName,AgtMiddleInitial,AgtLastName,AgtBusPhone,AgtEmail,AgtPosition FROM agents WHERE AgencyId=2 ";

	if($result = mysqli_query($dbh,$sql))
	{
		while($row = mysqli_fetch_row($result))
		{
		print("<div class='acol'>
			<div class='card'>
			  <img src='$photo[$i]' alt='Avatar' class='image'>
			  <div class='middle'>
			  		<p>Email:$row[4]</p>
			  		<p>Phone:$row[3]</p>
    				<div class='text'>
    				<a href='mailto:$row[4]' target='_top' style=' text-decoration:none;'>Send Email</a>
    				</div>
  			  </div>
			  <div class='container'>
			    <p><b>$row[0] $row[1] $row[2]</b></p> 
			    <i>$row[5]</i> 			    
			  </div>
			</div>
	    </div>");
	    $i++;
		}	
	}
?>
    </div>
</div>
	<div class="parallax4"></div>

            <script src="scripts/stickynav.js"></script>
            <?php
                include("footer.php"); //<!--Added by kennard    -->
            ?>
        </div>
    </div>
</body>
</html>