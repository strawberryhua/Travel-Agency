<?php
	#---------------------------------------------
	#Dean Jones
	#Nov.14, 2016
	#DJ_CUSTOMER_TESTER.PHP (UPDATE SQL DATA)
	#-------------------------
	#SUPPORTING FILES
		#DJ_CUSTOMER_FORM_REGISTER.PHP		(customer insert data form)
		#DJ_CUSTOMER_TESTER.PHP				(tester)
		#DJ_CUSTOMER_UPDATE_SUCCESSFUL.PHP	(if validated)
	#---------------------------------------------
	#VARIABLES
	include('variable.php');

	#******************************************************************
	#******************************************************************
	#UPDATE-DATA FUNCTION
	function updateData($data, $table)
	{
		#-------------------------------------------------------------
		 #COLUMN HEADERS
		$keys = array_keys($data);								//grab keys ARRAY
		$colnames = implode(", ", $keys);						//turn ARRAY TO STRING

		#COLUMN VALUES(DATA)		
		$values = array_values($data);							//grab values ARRAY
		$colvalues = "'" . implode("', '", $values) . "'";		//turn ARRAY TO STRING
		
		#SQL (UPDATE) QUERY
		#HUA ADDED SESSION VARIABLE (Nov...)
		/* $sql = "UPDATE `customers` SET `CustFirstName`='$data[CustFirstName]',`CustLastName`='$data[CustLastName]',
		`CustAddress`='$data[CustAddress]',`CustCity`='$data[CustCity]',`CustProv`='$data[CustProv]',`CustPostal`='$data[CustPostal]',`CustCountry`='$data[CustCountry]',
		`CustHomePhone`='$data[CustHomePhone]',`CustBusPhone`='$data[CustBusPhone]',`CustEmail`='$data[CustEmail]',`AgentId`=$data[AgentId] WHERE CustomerId=$data[CustomerId]"; */
		$sql = "UPDATE `customers` SET `CustFirstName`='$data[CustFirstName]',`CustLastName`='$data[CustLastName]',
		`CustAddress`='$data[CustAddress]',`CustCity`='$data[CustCity]',`CustProv`='$data[CustProv]',`CustPostal`='$data[CustPostal]',`CustCountry`='$data[CustCountry]',
		`CustHomePhone`='$data[CustHomePhone]',`CustBusPhone`='$data[CustBusPhone]',`CustEmail`='$data[CustEmail]',`AgentId`=$data[AgentId],`CustUserName`='$data[CustUserName]',`CustPassword`='$data[CustPassword]' WHERE CustomerId=$data[CustomerId]";
		
		print($sql);

		#-------------------------------------------------------------
	  	
		#-------------------------------------------------------------
		#DB CONNECT
			global $host, $user, $password, $database;
			$dbh = mysqli_connect($host, $user, $password, $database);
				#ERROR IF DATABASE DOESN'T CONNECT
				if(!$dbh)											#IF (NOT CONNECTED) TO DATABASE
				{
					#CREATE A (LOG FILE)
					$file = fopen("log/errorlog.txt", "a");			#OPENS FILE (OR CREATES)(TO APPEND)
					fwrite($file, mysqli_connect_error() . "\n");	#WRITES TO FILE
					fclose($file);									#CLOSES FILE
					exit;											#MAKES SURE IT DOESN'T CONTINUE WITHOUT A CONNECTION
				}
					/* 	 $dbh = mysqli_connect($host, $user, $password, $database);
						if (!$dbh)
						{
						 print(mysqli_connect_error());
						 return false;
					} */			
		#END DB CONNECT
		#-------------------------------------------------------------

		#-------------------------------------------------------------
		#SEND QUERY
			if (mysqli_query($dbh, $sql))
			{
				print("<br />*** SQL INSERT successful! ***<br />");
			} 
			else
			{
				print("******************************");
				print("<br />SQL_INSERT_ERROR: " . mysqli_error($dbh) . "<br />");
				print(mysqli_query_error());
				print("******************************");
			}
		#-------------------------------------------------------------
		#DB CLOSE
			mysqli_close($dbh);
		#-------------------------------------------------------------
	}#end UPDATE-DATA FUNCTION
	
	#**********************************
	#RUN QUERY
	updateData($_REQUEST, "customers");
	
	#REDIRECT TO SUCCESSFUL PAGE
	header("Location:dj_customer_update_successful.php");
	#**********************************
	
	#******************************************************************
	#******************************************************************

?>