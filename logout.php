<!--
Author:Alex T.  
Course Code:PROJ207
Program:OOSD
Description: Session data destroy happens here
-->

<?php
require 'checkagentlogin2.php';
session_destroy();
header("Location: agentlogin2.php");
?>
