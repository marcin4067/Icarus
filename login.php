<?php session_start();
session_regenerate_id();
include('php/functions.php');
//Check that both a user name and user password have been set


echo $_POST['email'];
echo $_POST['userpass'];

if(isset($_POST['email']) && isset($_POST['userpass']))
{
	$db=createConnection();
	//Assign POSTed values to variables
	$email=$_POST['email'];
	$userpass=$_POST['userpass'];
	//Create query, note that parameters being passed in are represented by question marks
	$loginsql="select userid, userpass, salt, firstname, lastname, utype from user where email=?;";
	$lgnstmt = $db->prepare($loginsql);
	//Bound parameters are defined by type, s = string, i = integer, d = double and b = blob
	$lgnstmt->bind_param("s",$email);
	//Run query
	$lgnstmt->execute();
	//Store Query Result
	$lgnstmt->store_result();
	//Bind returned row parameters in same order as they appear in query
	$lgnstmt->bind_result($userid,$hash,$salt,$firstname,$lastname,$usertype);
	//Valid login only if exactly one row returned, otherwise something iffy is going on
	
	if($lgnstmt->num_rows==1) 
	{
	   
		//Fetch the next (only) row from the returned results
		$lgnstmt->fetch();
		echo "  sid $userid h $hash s $salt f $firstname l $lastname u $usertype";
		$cyphertext=makeHash($userpass,$salt,50);
		if($cyphertext==$hash) 
		{
			//Update user's record with session data
					$loggedIn = true;
					$_SESSION['loggedIn']=$loggedIn;
					$sessionsql="update user set sessionid=? where userid=?;";
					$sessionstmt=$db->prepare($sessionsql);
					$sessionstmt->bind_param("si",session_id(),$userid);
					$sessionstmt->execute();
					$sessionstmt->close();
					// Store logged in studentid as session variable
					$_SESSION['userid']=$userid;
					$_SESSION['email'] = $email;
					$_SESSION['usertype'] = $usertype;
					$_SESSION['firstname'] = $firstname;
					$_SESSION['lastname'] = $lastname;
					if ($usertype==3) 
					{
						header("location: admin.php");
						exit();
					} 
					elseif ($usertype==2) 
					{
						header("location: teacher.php");
						exit();
					} 
					else if($usertype==1) 
					{
						header("location: classes.php");
						exit();
					} 
					else 
					{
						header("location: logout.php");
						exit();
					}
		} 
		else 
		{
			echo "<p>Login is not correct, please return to login screen and check your details</p>";
		}
	}
	$lgnstmt->close();
	$db->close();
} 
else 
{
	echo "<p>Login details not submitted, please return to login screen and check your details</p>";
}
?>
