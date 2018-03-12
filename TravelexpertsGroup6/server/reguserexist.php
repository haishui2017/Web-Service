<!--Author: Haishui Zhu 
Course: CPRG210 
Created: Nov 5,2017
-->

<?php 

     include("conn.php");
    $dbh = mysqli_connect($host, $user, $password, $dbname);
		if (!$dbh)
		{
			print(mysqli_connect_error() . "<br />");
			exit();
		}
     $query = mysqli_query($dbh, "SELECT * FROM customers WHERE CustUserName='".$_POST['lname']."'");
	
	 $find=mysqli_num_rows($query);
	 
echo $find;//返回值
mysqli_close($dbh);

?>