<!--Author: Kennard-->
<!--Course: CPRG210-->
<!--Created: Nov 6th, 2017-->
<!--this file is called when the user clicks the logout out button-->
<?php
    session_start();
    unset($_SESSION["currentpage"]);
    unset($_SESSION["loggedin"]);
    unset($_SESSION["CustFirstName"]);
    header("location: index.php");
?>