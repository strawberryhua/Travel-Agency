<!--
Author:Alex T.  
Course Code:PROJ207
Program:OOSD
Description: agent update succsess check
-->
<?php
   session_start();
   print(session_id());
   include("atfunctions.php");

   $message = "";

  
   if (!isset($_REQUEST['AgtFirstName']))
   {
      header("Location: agentupdate.php");
   }
   else
   {
	   if (validate())
	   {
		   if (updateData($_REQUEST, "agents"))
		   {
			  print("Data was successfully updated to the database");
			  header("Location: agent_update_successful.php");
		   }
		   else
		   {
			  print("Data could not be saved to the database, call tech support");
		   }
	   }
	   else
	   {
	      if ($message)
		  {
		     $_SESSION["message"] = $message;
			 $_SESSION["data"] = $_REQUEST;
		  }
		  header("Location: agentupdate.php?AgentId=$_REQUEST[AgentId]");
	   }
   }
?>
