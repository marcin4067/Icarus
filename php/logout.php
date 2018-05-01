<?php
session_start();
include("functions.php");
$studentid=&$_SESSION['studentid'];
$sessionid=session_id();
if(!is_null($studentid)) 
{
	
	$clearquery="update user set sessionid='a' where userid=? and userid=?;";
	$db=createConnection();
	$doclear=$db->prepare($clearquery);
	$doclear->bind_param("ii",$userid,$userid);
	$doclear->execute();
	$doclear->close();
	$db->close();
}
session_unset();
session_destroy();
header("location: ../index.php");
?>
