<!--
Author:Alex T.  
Course Code:PROJ207
Program:OOSD
Description: agent insert table.
-->

<?php
//by Alex T.
	$title="Agent Insert";
   session_start();
   include("variable.php");
   if (!isset($_SESSION["AgtUserId"]))
   {
      header("Location: agentlogin2.php");
   }
?>
   
   <script>
       function validate() //validation Function to check if input was empty
		 {
		    var status = true;
			var message = "";
			var myfname = document.getElementById("fname");
			if (myfname.value == "")
			{
			   message += "First Name must have a value<br />";
			   myfname.style.backgroundColor = "red";
			   status = false;
			}

			var mymname = document.getElementById("mname");
			if (mymname.value == "")
			{
			   message += "mymname must have a value<br />";
			   mymname.style.backgroundColor = "red";
			   status = false;
			}

			var mylname = document.getElementById("lname");
			if (mylname.value == "")
			{
			   message += "Last Name must have a value<br />";
			   mylname.style.backgroundColor = "red";
			   mylname.focus();
			   status = false;
			}

			var phone = document.getElementById("busphone");
			if (phone.value == "")
			{
			   message += "Phone must have a value<br />";
			   phone.style.backgroundColor = "red";
			   phone.focus();
			   status = false;
			}

			if (status)
			{
			   return confirm("continue to submit?");
			}
			else
			{
			   return false;
			}
			
		 }

		 function showHideInfo(id, visCode)
		 {
		    document.getElementById(id).style.visibility = visCode;
		 }
   </script>

	<?php 
		include_once 'grpheader.php';
		include("mainmenu_agent.php");
	?>

<h2>Add New Agent</h2>
<?php
	if (isset($_SESSION["message"]))
 {
    print($_SESSION["message"]);
	unset($_SESSION["message"]);
 }
?>
<article style="margin-left:27%">
      <table>
      	  <form method="post" action="tester.php"> <!-- creating table for insert -->

        <tr>
      	    <td> First Name:</td><td><input type="text" id="fname" name="AgtFirstName" onfocus="showHideInfo('fn', 'visible')" 
			onblur="showHideInfo('fn', 'hidden')" /></td>
        </tr>
        <tr>
             <td>Middle Name:</td><td><input type="text" id="mname" name="AgtMiddleInitial" onfocus="showHideInfo('mn', 'visible')" 
			 onblur="showHideInfo('mn', 'hidden')" /></td>
        </tr>
        <tr>
             <td>Last Name:</td><td><input type="text" id="lname" name="AgtLastName"  onfocus="showHideInfo('ln', 'visible')" 
			 onblur="showHideInfo('ln', 'hidden')"  /></td>
        </tr>
        <tr>
             <td>Business Phone:</td><td><input type="text" id="busphone" name="AgtBusPhone"  onfocus="showHideInfo('bp', 'visible')" 
			 onblur="showHideInfo('bp', 'hidden')" /></td>
        </tr>
        <tr>
             <td>Email:</td><td><input type="text" id="email" name="AgtEmail" onfocus="showHideInfo('em', 'visible')" 
			 onblur="showHideInfo('em', 'hidden')" /></td>
        </tr>
        <tr>
      		 <td>Agent Position:</td><td><input type="text" id="position" name="AgtPosition"  onfocus="showHideInfo('ap', 'visible')" 
			 onblur="showHideInfo('ap', 'hidden')" /></td>
        </tr>
        <tr>
      		 
               <td>Agency Id:</td><td><select name="AgencyId"> <!-- loading agency data from database -->
					<?php

						$dbh = mysqli_connect($host, $user, $password, $database); //handle
						if(!$dbh)
						{
						  print(mysqli_connect_error());
						}
						$sql="select AgencyId, AgncyAddress, AgncyCity, AgncyProv, AgncyCountry from agencies";
						$result = mysqli_query($dbh, $sql);
						if(!$result)
						{
							myqli_error($dbh);
						}
						while($row = mysqli_fetch_row($result)) //stores query results as enum array
						  {
							print("<option value='$row[0]'>$row[1],\n $row[2], $row[3], $row[4]</option>");
						  }

						  mysqli_close($dbh);
						   ?>
						 </select>
					   </td>
	    </tr>
        <tr>
           <td>Agent User Id:</td><td><input type="text" id="userid" name="AgtUserId"  onfocus="showHideInfo('au', 'visible')" 
		   onblur="showHideInfo('au', 'hidden')" /></td>
        </tr>
        <tr>
           <td>Agent Password:</td><td><input type="password" id="password" name="AgtPassword"  onfocus="showHideInfo('pp', 'visible')" 
		   onblur="showHideInfo('pp', 'hidden')" /></td>
        </tr>
        <tr>
          <td><input type="reset" onclick="return window.confirm('Did you really want to reset?')" /></td>
           <td><input type="submit" onClick="return validate()"/></td>
        </tr>

      	  </form>
      </table>
    </article>

 <?php
  require("grpfooter.php");
 ?>
