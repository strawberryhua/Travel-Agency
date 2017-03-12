<!--Author:Hua Hong
Course Code:PROJ207
Program:OOSD
Description:add a customer record to database 
-->
<?php
   session_start();
   $title="Travel Experts Process Customer Insert page";
     include("grpheader.php");
	 require("mainmenu.php");
  include("functions.php");
   
   if (!isset($_REQUEST['CustFirstName'])||!isset($_REQUEST['CustUserName'])|| !isset($_REQUEST['CustPassword']) )
   {
      header("Location: custregister.php");
   }
   else
   {
	   
		   if (insertData($_REQUEST, "customers"))
		   {
			  header("Location:grp_index.php");
		   }
		   else
		   {
			  print("Data could not be saved to the database, call tech support");
		   }
	  
   }
?>
