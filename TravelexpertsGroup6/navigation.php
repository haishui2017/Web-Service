<!--Author: Farshad and Kennard-->
<!--Course: CPRG210-->
<!--Created: Nov 10th, 2017-->
<?php
    if (isset($_SESSION["loggedin"]))
    {
        $user_status = "Logout";
        $go_to = "logout.php";
        $signupstyle = "none";
        $profilestyle = "block";
    }	
    else
    {
        $user_status = "Login";
        $go_to = "login.php";
        $signupstyle = "block";
        $profilestyle = "none";
    }
?>
<label class="currentuser">
    <?php 
    (isset($_SESSION["CustFirstName"])) ? $current_user = strtoupper($_SESSION["CustFirstName"]) : $current_user = "My Account"; 
    ?>
</label>

<div id="top" class="top_navbar">
    <a href="index.php">HOME</a>
    <a href="aboutus.php">ABOUT</a>
    <a href="package.php">PACKAGES</a>
    <div style="float:right;" class="dropdown">
        <button class="dropbtn"><?php print($current_user); ?>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?php print($go_to); ?>" id="login" class="userstatus">
                <?php print($user_status);?>
            </a>
            <a href="profile.php" style="display: <?php print($profilestyle); ?>" id="myprofile" class="myprofile">View Profile</a>
        </div>
    </div> 
    <a href="register.php" style="float:right; display: <?php print($signupstyle); ?>" class="signup">SIGN UP</a>
    <a href="contact.php" style="float:right;" class="contactus">CONTACT US</a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="makeResponsive()">&#9776;</a>
</div>
