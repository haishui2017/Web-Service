<!--Author: Haishui Zhu 
Course: CPRG210 
Created: Nov 5,2017
-->
<?php
	session_start();

	include("regfunctions2.php");
	
	if ($_REQUEST)
	{	
			//$data = $_REQUEST;//dont need validation cause it was finished in register.php
        
    $data["CustFirstName"] = $_REQUEST["CustFirstName"];
	$data["CustLastName"] = $_REQUEST["CustLastName"];
	$data["CustAddress"] = $_REQUEST["CustAddress"];
	$data["CustCity"] = $_REQUEST["CustCity"];
	$data["CustProv"] = $_REQUEST["CustProv"];
	$data["CustPostal"] = $_REQUEST["CustPostal"];
	$data["CustCountry"] = $_REQUEST["CustCountry"];
    $data["CustHomePhone"] = $_REQUEST["CustHomePhone"];
    $data["CustBusPhone"] = $_REQUEST["CustBusPhone"];
    $data["CustEmail"] = $_REQUEST["CustEmail"];
    $data["AgentId"] = 0;
    $data["CustUserName"] = $_REQUEST["CustUserName"];
    $data["CustPassword"] = password_hash($_REQUEST["Password"], PASSWORD_DEFAULT);
		
	}
	else
	{
		//store message in session to send back to form,keep this just for testing session
		$_SESSION["message"] = "You must fill in the regist form first!"; //directly open savecustomer.php 
		
		header("Location: register.php");
	}
	
   
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
        if ( !empty($_REQUEST["CustFirstName"])) //block null recorder is inserted into table !
		{
			$message = insertRow("customers", $data);
		    $_SESSION["message"] = $message ;
		    $_SESSION["registered"] = true ;
            
            header("Location: ../registerthankyou.php");
	    }
	?>
</body>
</html>



