<?php
function createConnection() {
	$host="localhost";
    $user="root";
    $userpass='';
    $schema="teamgroup";
	$conn = new mysqli($host,$user,$userpass,$schema);
	if(mysqli_connect_errno()) {
		echo "Could not connect to database: ".mysqli_connect_errno();
		exit;
	}
	return $conn;
}
function getSalt($saltLength) {
	$randomString= bin2hex(mcrypt_create_iv($saltLength, MCRYPT_DEV_URANDOM));
return $randomString;
}

function makeHash($plainText,$salt,$n) {
	$hash=$plainText.$salt;
	for($i=0;$i<$n;$i++) {
		$hash=hash("sha256",$plainText.$hash.$salt);
	}
	return $hash;
}
//Params passed in
//$usersessionID = user's id, $sessionID=session_id()
//$ptype = level of access required for current page 1,2 or 3
function checkUser($usersessionID,$sessionID,$ptype) {
	$dbchk = createConnection();
	$lookupsql="select userLevel,sessionID,username from dsuser where userID=?";
	$lookup=$dbchk->prepare($lookupsql);
	$lookup->bind_param("i",$usersessionID);
	$lookup->execute();
	$lookup->store_result();
	$lookup->bind_result($utype,$storedsession,$uname);
	$lookup->fetch();
	if($lookup->num_rows==1) {
		$lookup->close();
		$dbchk->close();
		if($sessionID!=$storedsession || $storedsession=="" || $utype>$ptype) {
			header("location: logout.php");
		}
	} else {
		$lookup->close();
		$dbchk->close();
		header("location: logout.php");
	}
	return $uname;
}
