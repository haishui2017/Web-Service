<!--Author: Farshad and Kennard-->
<!--Course: CPRG210-->
<!--Created: Nov 6th, 2017-->
<?php
//    session_start();
    if (isset($_SESSION["loggedin"]))
    {
        $footsignupstyle = "none";
    }	
    else
    {
        $footsignupstyle = "block";
    }
?>

<footer class="footer">
    <div class="bottom-links">
        <div class="links">
            <a href="index.php">Home</a>
            <a href="aboutus.php">About</a>
            <a href="package.php">Vacation Packages</a>
            <a href="register.php" style="display: <?php print($footsignupstyle); ?>">Sign Up</a>
            <a href="contact.php">Contact</a>
        </div>    
    </div>
    <p class="copyright">&copy; 2017 by Travel Experts Inc. All rights reserved.</p>
</footer>