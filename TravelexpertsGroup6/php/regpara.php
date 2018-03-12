<!--Author: Haishui Zhu 
Course: CPRG210 
Created: Nov 5,2017
-->
<?php
   session_start();

     $c=$_REQUEST["province"];
        if(isset($_REQUEST["uname"]))
		
		{ if(!empty($_REQUEST["uname"]))
			
			{$_SESSION["CustUserName"]=$_REQUEST["uname"];}
			else
			{$_SESSION["CustUserName"]="";}	
		   	
		}
	   if(isset($_REQUEST["fname"]))
		
		{ if(!empty($_REQUEST["fname"]))
			
			{$_SESSION["CustFirstName"]=$_REQUEST["fname"];}
			else
			{$_SESSION["CustFirstName"]="";}	
		   	
		}
		if(isset($_REQUEST["lname"]))
		
		{ if(!empty($_REQUEST["lname"]))
			
			{$_SESSION["CustLastName"]=$_REQUEST["lname"];}
			else
			{$_SESSION["CustLastName"]="";}	
		   	
		}
		if(isset($_REQUEST["email"]))
		
		{ if(!empty($_REQUEST["email"]))
			
			{$_SESSION["CustEmail"]=$_REQUEST["email"];}
			else
			{$_SESSION["CustEmail"]="";}	
		   	
		}
		if(isset($_REQUEST["homephone"]))
		
		{ if(!empty($_REQUEST["homephone"]))
			
			{$_SESSION["CustHomePhone"]=$_REQUEST["homephone"];}
			else
			{$_SESSION["CustHomePhone"]="";}	
		}
		if(isset($_REQUEST["cellphone"]))
		
		{ if(!empty($_REQUEST["cellphone"]))
			
			{$_SESSION["CustBusPhone"]=$_REQUEST["cellphone"];}
			else
			{$_SESSION["CustBusPhone"]="";}	
		}
		
		if(isset($_REQUEST["psw"]))
		
		{ if(!empty($_REQUEST["psw"]))
			
			{$_SESSION["Password"]=$_REQUEST["psw"];}
			else
			{$_SESSION["Password"]="";}	
		}
		
		if(isset($_REQUEST["psw2"]))
		
		{ if(!empty($_REQUEST["psw2"]))
			
			{$_SESSION["psw-repeat"]=$_REQUEST["psw2"];}
			else
			{$_SESSION["psw-repeat"]="";}	
		}
		
		if(isset($_REQUEST["home"]))
		
		{ if(!empty($_REQUEST["home"]))
			
			{$_SESSION["CustAddress"]=$_REQUEST["home"];}
			else
			{$_SESSION["CustAddress"]="";}	
		}
		
		if(isset($_REQUEST["postal"]))
		
		{ if(!empty($_REQUEST["postal"]))
			
			{$_SESSION["CustPostal"]=$_REQUEST["postal"];}
			else
			{$_SESSION["CustPostal"]="";}	
		}
		if(isset($_REQUEST["country"]))
		
		{ if(!empty($_REQUEST["country"]))
			
			{$_SESSION["CustCountry"]=$_REQUEST["country"];}
			else
			{$_SESSION["CustCountry"]="";}	
		}
	header('Location: ../register.php?province='.$c);
 
?>
<html>

</html>