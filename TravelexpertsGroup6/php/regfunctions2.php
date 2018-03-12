<!--Author: Haishui Zhu 
Course: CPRG210 
Created: Nov 5,2017
-->
<?php
	function buildtypestring($dbh, $table)
	{
			//get table info to build type string for bind param function
		$typestring = "";
		$res = mysqli_query($dbh, "DESCRIBE $table");
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

	function insertRow($table, $data) //this function takes the form input values and store in the database after validation
	{
		include("../server/conn.php");
		$message = "";

		$keys = array_keys($data);
		$keystring = implode(",", $keys);
		print("keystring: $keystring<br />");
		$questionmarks = "";
		for ($i=0; $i<count($keys); $i++)
		{
			$questionmarks .= "?,";
		}
		$questionmarks = rtrim($questionmarks, ",");
		$sql = "INSERT INTO $table($keystring)"
			. "VALUES ($questionmarks)";
		print($sql . "<br />");
		
		$dbh = mysqli_connect($host, $user, $password, $dbname);
		if (!$dbh)
		{
			print(mysqli_connect_error() . "<br />");
			exit();
		}
		
		//get table info to build type string for bind param function
		$typestring = buildtypestring($dbh, $table);
		print($typestring . "<br />");
		
		$stmt = mysqli_prepare($dbh, $sql);
		
		//bind the data
		$args = array($typestring);
		reset($keys);
		foreach ($keys as $key)
		{
			$args[] = &$data[$key];
		}
		call_user_func_array(array($stmt,"bind_param"), $args);
		
		if ($result = mysqli_stmt_execute($stmt))
		{
			$message = "Thank you. You have successfully registered!";
		}
		else
		{
			$message = "Unable to register at this time. Please contact Travel Experts technical support!";
		}
		mysqli_close($dbh);
		return $message;
	}
	
	
	
?>




