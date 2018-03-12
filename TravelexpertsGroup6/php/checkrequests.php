<!--
    Author: Kennard S.
    Course: CPRG210 
    Created: Nov 6,2017
-->
<?php
    session_start();
    include("functions.php");

    if (isset($_REQUEST["CustUserName"])) //check if coming from the login page
    {
        //process the form data        
		$errors = validateFields($_REQUEST);
		if (!$errors)
		{
			if (validateUser($_REQUEST, "customers"))
            {
                $_SESSION["loggedin"] = true;
                
                if (isset($_SESSION["currentpage"]) and ($_SESSION["currentpage"] != "") and (isset($_SESSION["PackageId"])))
				{
					$current_page = $_SESSION["currentpage"];
					unset($_SESSION["currentpage"]);
					header("location: $current_page");
				}
				else
				{				
					header("location: ../package.php");	
				}
            }
            else
            {
                $_SESSION["message"] = "You may have entered an unknown email address or an incorrect password.";
                header("Location: ../login.php");
            }
		}
		else
		{
            $_SESSION["message"] = $errors;
			header("Location: ../login.php");
		}
    }
	else if (isset($_SESSION["PackageId"])) //check if coming from the booking details page
	{	
        $errors = validateFields($_REQUEST); //check if any fields are empty
		if (!$errors)
		{
			if (addBooking("bookings", "creditcards")) //pass 'bookings' table  the addbooking function 
            {
                $_SESSION["bookingmessage"] = "Your package has been booked!";
                header("Location: ../thankyou.php");
            }
            else
            {
                $_SESSION["bookingmessage"] = "We are unable to complete this transaction. Please contact your Travel Experts agent";
                header("Location: ../thankyou.php");
            }
		}
		else
		{
            $_SESSION["message"] = $errors;
			header("Location: ../bookingdetails.php");
		}
    }
    else
	{	
        if (isset($_SESSION["loggedin"])) 
        {
            header("Location: ../package.php");
        }
        else
        {
            header("Location: ../login.php");
        }
	}
?>