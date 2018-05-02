<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
include('php/functions2.php');
$_SESSION['userid']=$userid;
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
    //echo $userid;
    
    $firstname= generateRandomString();
    $lastname=generateRandomString();
    $username=generateRandomString();
    $userpass=$_POST['email'];
    $email=$_POST['email'];   
    $utype = 1;
    $salt=getSalt(16);
    $cryptpass=makeHash($userpass,$salt,50);
    $sessionid = "a";
    $xp = 1;
   
    
    $db = createConnection();
    
    $sql2 ="select schoolid from user where userid=?;";
    $stmt2=$db->prepare($sql2);
    $stmt2->bind_param("i",   $userid);
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
                    echo "<p>student added</p>";
                    echo "<a href='teacher.php'>Click here to go to Teacher page</a>";
                }
                else 
                {
                    echo "is problem";
                }
            $inst->close();
        }
        else 
        {
            echo "is problem to find a school";
        }
        $stmt2->close();
        $db->close();
        
    ?>
    
   </div>
 </div>
</body>
</html>