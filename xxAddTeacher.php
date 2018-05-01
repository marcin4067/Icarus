<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
//include('php/functions2.php');
$_SESSION['userid']=$userid;
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Classes</title>
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" type="text/css" media="screen and (max-width:992px)" href="css/mobiles.css" />

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
<?php
//menus();
?>   
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
    
   </div>
 </div>
 <div class="row">
   
   <div id="mainContent" class="col m8 offset-m3">
    <?php     
    $firstname=$_POST['firstName'];
    $lastname=$_POST['lastName']; 
    $schoolid=$_POST['schoolid'];
    $email=$_POST['email'];
    $username = $firstname;
    //echo $firstname;
    //echo $lastname;
    //echo $schoolid;    
    $sessionid=session_id();
    $userpass=$_POST['email'];   
    $salt=getSalt(16);
    $cryptpass=makeHash($userpass,$salt,50);
    $utype=2;
    
    $xp = 1;
    
    $db = createConnection();     
    $sql ="select userid from user where firstname = ? and lastname= ? and schoolid = ? and utype = 2;";
    $stmt=$db->prepare($sql);
    $stmt->bind_param("ssi", $firstname, $lastname, $schoolid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($userid);
    if ($stmt->num_rows != 0)
    {
        echo "That Teacher exist";
        
        session_destroy();
    }
    else
    {        
       $insertquery="INSERT INTO `user`(`firstname`,`lastname`,`username`,`userpass`,`salt`,`email`,`sessionid`,`utype`,`xp`,`schoolid`) VALUES (?,?,?,?,?,?,?,?,?,?);";
       $inst=$db->prepare($insertquery);
       //echo $username.' fn:'.$firstname. ' ln:'.$lastname.' s:'.$salt.' c:'.$cryptpass.' se:'.$sessionid.' sch:'.$schoolid.' e:'.$email.' ut:'.$utype.' xp:'.$xp;
       $inst->bind_param("sssssssiii",  $firstname, $lastname, $username, $cryptpass, $salt, $email, $sessionid, $utype, $xp, $schoolid);
       $inst->execute();
        // check user inserted, if so create login form
         if($inst->affected_rows==1)
         {	
           echo "Teacher added";
         }
         else 
         {
            echo "is problem";
         }
         $inst->close();
         session_destroy();
    }
    $stmt->close();
    $db->close();
    ?>
    
   </div>
 </div>
</body>
</html>