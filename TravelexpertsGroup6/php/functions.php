<!--
Authors: Cecilia and Kennard 
Course: CPRG210 
Created: Nov 5,2017
-->
<?php
	include("../server/conn.php");
    date_default_timezone_set('Canada/Mountain');

	function validateFields($data_array) //checks if any input fields are empty and sends an error message back
	{	
		$message = "";
        foreach ($data_array as $k=>$v)
        {
            if ($v == "")
            {   
                $message = "Form has missing field(s).";
            }
        }
		return $message;
	}
	
    function validateUser($user_array, $table) //compares the username and password the user enters to that of the database to see if we have a match
    {
        global $host, $user, $password, $dbname;
		$db_conn = mysqli_connect($host, $user, $password, $dbname);
        
        if (!$db_conn)
		{
			print(mysqli_connect_error);
			exit;
		}
        
        $userkey = "";
        $uservalue = "";    
        $passkey = "";
        $passvalue = "";
        
        foreach ($user_array as $k=>$v)
        {
            if ($k=="CustUserName")
            {
                $userkey = $k;
                $uservalue = $v;
            }            
            if ($k=="CustPassword")
            {
                $passkey = $k;
                $passvalue = $v;
            }
        }
        
        $result = mysqli_query($db_conn, "SELECT * FROM $table WHERE CustUserName='$uservalue' OR CustEmail='$uservalue'");
        if ($result)
        {
            if ($row = mysqli_fetch_assoc($result))
            {
                $temp_hash_pass = $row["CustPassword"];
                if (password_verify($passvalue, $temp_hash_pass))
                {
                    $_SESSION["CustomerId"] = $row["CustomerId"];
                    $_SESSION["CustFirstName"] = $row["CustFirstName"];
                    return true;
                }                
                else
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
    }

    function addBooking($table1, $table2) // add a new booking to the database
    {
        global $host, $user, $password, $dbname;
		$db_conn = mysqli_connect($host, $user, $password, $dbname);
        
        if (!$db_conn)
		{
			print(mysqli_connect_error);
			exit;
		}
        
        $keys = array();
        $question_marks = "";
        $booking_data_types = "";
        $cc_data_types = "";
        
        $booking_data_types = buildtypestring($db_conn, $table1);
        $cc_data_types = buildtypestring($db_conn, $table2);

        $args = array($booking_data_types);
        
        date_default_timezone_set('Canada/Mountain');
        
        $package_array["BookingDate"] = date("Y-m-d H:i:s");
        $package_array["TravelerCount"] = $_SESSION["TravelerCount"];
        $package_array["TripTypeId"] = $_SESSION["TripTypeId"];
        $package_array["DepartureCity"] = $_SESSION["DepartureCity"];
        $package_array["CustomerId"] = (int)$_SESSION["CustomerId"];
        $package_array["PackageId"] = (int)$_SESSION["PackageId"];
        $package_array["BookingNo"] = generateRandomString(5);
        $_SESSION["BookingNo"] = $package_array["BookingNo"] ;
        
        $ccname = $_SESSION["CCName"];
        $ccnum = password_hash($_SESSION["CCNumber"], PASSWORD_BCRYPT); //encrypt the credit card number before storing on database
        $ccexp = $_SESSION["CCExpiry"];
        $custid = (int)$_SESSION["CustomerId"];

        foreach ($package_array as $k=>$v)
		{
            $keys[] = $k;
            $args[] = &$package_array[$k];
            $question_marks .= "?,";
		}
        
        $keystring = implode(",", $keys);
        $question_marks = rtrim($question_marks, ",");

        //create booking table sql statement
        $sql_book = "INSERT INTO $table1 ($keystring) VALUES ($question_marks);";
		$stmt_book = mysqli_prepare($db_conn, $sql_book);
        
        //check if customer has credit card in the credit card table. If there is one use UPDATE, else use INSERT
        $result = mysqli_query($db_conn, "SELECT * FROM $table2 WHERE CustomerId='$custid'");
        if (mysqli_num_rows($result) > 0)
        {
            $sql_cc = "UPDATE $table2 SET CCName=?, CCNumber=?, CCExpiry=? WHERE CustomerId=?;";
        }
        else
        {
            $sql_cc = "INSERT into $table2 (CCName, CCNumber, CCExpiry, CustomerId) VALUES (?,?,?,?)";
        }

        //create cc table sql statement
		$stmt_cc = mysqli_prepare($db_conn, $sql_cc);
        
		call_user_func_array(array($stmt_book, 'bind_param'), $args);
        mysqli_stmt_bind_param($stmt_cc, $cc_data_types, $ccname, $ccnum, $ccexp, $custid);

        $result_book = mysqli_stmt_execute($stmt_book);
        $result_cc = mysqli_stmt_execute($stmt_cc);
		if ($result_book and $result_cc)
		{
			//send back a success message using sessions
            unset($_SESSION["TravelerCount"]);
            unset($_SESSION["TripTypeId"]);
            unset($_SESSION["TravelerCount"]);
            unset($_SESSION["DepartureCity"]);
            if (isset($_SESSION["CCNumber"]))
            {
                unset($_SESSION["CCNumber"]);
                unset($_SESSION["CCName"]);
                unset($_SESSION["CCExpiry"]);
            }
            return true;
		}
		else
		{
			//send back a failure message using sessions
            unset($_SESSION["BookingNo"]);
            return false;
		}
		mysqli_close($db_conn);
    }

    function buildtypestring($db_conn, $table) //this function wa provided by Harv P. during class. It gets the data types from the database for a specific table
	{
			//get table info to build type string for bind param function
		$typestring = "";
		$res = mysqli_query($db_conn, "DESCRIBE $table");
		while($row = mysqli_fetch_assoc($res))
		{
			if ($row["Extra"] != "auto_increment")
			{
				$match = array();
				preg_match("/^[a-z]+/", $row['Type'], $match);
				switch ($match[0])
				{
					case "tinyint";
					case "smallint";
					case "mediumint";
					case "bigint";
					case "int":
						$typestring .= "i";
						break;
					case "decimal";
					case "double";
					case "real";
					case "float":
						$typestring .= "d";
						break;
					case "tinytext";
					case "mediumtext";
					case "longtext";
					case "date";
					case "time";
					case "timestamp";
					case "datetime";
					case "year";
					case "varchar":
						$typestring .= "s";
						break;
					default:
						$typestring .= "b";
				}
			}
		}
		return $typestring;
	}

    //this function was created by Cecilia
    function generateRandomString($length) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;    
    }

?>