<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
include('php/functions2.php');
$_SESSION['userid']=$userid;
$teacherid=$_SESSION['userid'];
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Student</title>
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" type="text/css" media="screen and (max-width:992px)" href="css/mobiles.css" />

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
<?php include 'includes/nav.php';?>
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
    
   </div>
 </div>
 <div class="row">
   
   <div id="mainContent" class="col m8 offset-m3">
    <?php    
    echo $teacherid.' '.$userid;
    
    $firstname= generateRandomString();
    $lastname=generateRandomString();
    $username=generateRandomString();
    $userpass=$_POST['email'];
    $email=$_POST['email'];  
	$module=$_POST['module']; 	
    $utype = 1;
    $salt=getSalt(16);
    $cryptpass=makeHash($userpass,$salt,50);
    $sessionid = "a";
    $xp = 1;
   echo $email.'  '.$module.' '.$teacherid;
    
    $db = createConnection();
    $sqltest ="select userid from user where email=?;";
    $stmtTest=$db->prepare($sqltest);
    $stmtTest->bind_param("i",   $userid);
    $stmtTest->execute();
    $stmtTest->store_result();
    $stmtTest->bind_result($userid);
    if ($stmtTest->affected_rows==1) 		
	{
		echo "user with that email exist";
	}
	else
	{
		
	
		$sql2 ="select schoolid from user where userid=?;";
		$stmt2=$db->prepare($sql2);
		$stmt2->bind_param("i",   $teacherid);
		$stmt2->execute();
		$stmt2->store_result();
		$stmt2->bind_result($schoolid);
		if ($stmt2->affected_rows==1) 		
        {
            $stmt2->fetch();
            $insertquery="INSERT INTO `user`(`firstname`,`lastname`,`username`,`userpass`,`salt`,`email`,`sessionid`,`utype`,`xp`,`schoolid`) VALUES (?,?,?,?,?,?,?,?,?,?);";
            $inst=$db->prepare($insertquery);
            //echo $username.' fn:'.$firstname. ' ln:'.$lastname.' s:'.$salt.' c:'.$cryptpass.' se:'.$sessionid.' sch:'.$schoolid.' e:'.$email.' ut:'.$utype.' xp:'.$xp;
        
            $inst->bind_param("sssssssiii",  $firstname, $lastname, $username, $cryptpass, $salt, $email, $sessionid, $utype, $xp, $schoolid);
            $inst->execute();
            // check user inserted, if so create login form
            if($inst->affected_rows==1)
                {	
                   // echo "<p>student added</p>";
                   // echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
					$sql ="select userid from user where email=?;";
					$stmt=$db->prepare($sql);
					$stmt->bind_param("s", $email);
					$stmt->execute();
					$stmt->store_result();
					$stmt->bind_result($userid);
					if ($stmt->affected_rows==1) 
					{
						$stmt->fetch();
						$insertquery2="INSERT INTO `moduleassigned`(`moduleid`,`studentid`)VALUES(?,?);;";
						$inst2=$db->prepare($insertquery2);
						$inst2->bind_param("ii", $module,$userid  );
						$inst2->execute();
						if($inst2->affected_rows==1)
						{
							$userid = $teacherid;
							echo "<p>student added</p>";
							echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
							
						}
						else
						{
							$userid = $teacherid;
							echo "<p>is sproblem to add module</p>";
							echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
							
						}
						$inst2->close();
						
					}
					else
					{
						echo "is more than one user with the same email";
						echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
					
					}
				$stmt->close();
				}
                else 
                {
                    echo "is problem";
					echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
					
                }
				
            $inst->close();
        }
        else 
        {
            echo "is problem to find a school";
			echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
					
        }
        $stmt2->close();
	}
	
	$stmtTest->close();	
    $db->close();
        
    ?>
    
   </div>
 </div>
</body>
</html>