<!--
Author:Hua Hong  
Course Code:PROJ207
Program:OOSD
Description:check the customer login. If there is a match in database,redirect the customer to customer entry page
-->
<?php
  session_start();
  $title="Travel Expert Check Booking Login";
  include("grpheader.php");
  require("variable.php");
  $message = "";
  //validate if user enters CustUserName and CustPassword
  function validate()
  {
	  global $message;
	  if ($_REQUEST["CustUserName"]=="")
	  {
		  $message .="UserId must have value <br>";
	  }
	   if ($_REQUEST["CustPassword"]=="")
	  {
		  $message .="Password must have value <br>";
	  }
	  if($message)
	  {
		  return false;
	  }
	  else{
		  return true;
	  }
	  
  }
if(!isset($_REQUEST["CustUserName"]))
{
	$_SESSION["loginmessage"]="you must login first";
	
	header("Location:customerlogin.php");
}
else
{   
    if(validate())
	{
		
	//connect database 
	$dbh = mysqli_connect($host,$user,$password,$database);
	if(!$dbh)
	{
		//print(mysqli_connect_error());
		$fh = fopen("log/errorlog.txt","a");
		fwrite($fh, mysqli_connect_error()."\n");
		fclose($fh);
	}
	$sql = "select CustPassword from customers WHERE CustUserName=?";
	$stmt=mysqli_prepare($dbh,$sql);
	mysqli_stmt_bind_param($stmt,"s", $_REQUEST["CustUserName"]);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt,$pass);
	//validate if there is a match
	if(mysqli_stmt_fetch($stmt))
	{
		

	  if($pass != $_REQUEST["CustPassword"])
	  {
		  $_SESSION["loginmessage"]="Invalid user or password";
	
	     header("Location:customerlogin.php");
	  }
       else
       {
		   $_SESSION["loggedin"]="yes";
		   if(!isset($_SESSION["scriptname"]))
		   {
			    //if there is a match, redirect the user to signinindex page
				header("Location:signinindex.php");
				$_SESSION["user"]=$_REQUEST["CustUserName"];
		   }
		   else
		   {
			    header("Location:$_SESSION[scriptname]");
		   }
		   
	   }
	}
	else
	{
		$_SESSION["loginmessage"]="Invalid user or password";
	
	     header("Location:customerlogin.php");
	}
	mysqli_close($dbh);
	}
	else
	{
		$_SESSION["loginmessage"]=$message;
	
	
	     header("Location:customerlogin.php");
	}
	
	
	
}
?>
