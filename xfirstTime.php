<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Creaate Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="css/nav.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
  <?php
  
  include 'includes/nav.php';
  include "php/functions.php";
  $userid=$_POST['userid'];
  $email=$_POST['email'];
  $username=$_POST['username'];
  $firstname=$_POST['forename'];
  $lastname=$_POST['surname'];
  $userpass=$_POST['userpass'];
  $userpass2=$_POST['userpass2'];
  $utype=$_POST['utype'];
  $schoolid=$_POST['schoolid'];
  $xp = $_POST['xp'];  
  $salt=getSalt(16);
  $cryptpass=makeHash($userpass,$salt,50);
  
  $sessionid=session_id();
  
  $db = createConnection();
  $sql = "select email from user where userid=?;";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("i",$userid);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($tempEmail);  
  while($row=$stmt->fetch()) 
  {
      
      if($stmt-> num_rows()== 1)
      {
         
          $insertquery="update user set firstname=?, lastname=?, username=?, userpass=?, salt=?, email=?, sessionid=?, utype=?, xp=?, schoolid=? where userid=?";
          $inst=$db->prepare($insertquery);
          //echo $username.$userlevel.$firstname.$lastname.'s:'.$salt.'c:'.$cryptpass.'se:'.$sessionid.'sch:'.$school;
          $inst->bind_param("sssssssiiii", $firstname, $lastname, $username, $cryptpass, $salt, $email, $sessionid, $utype, $xp, $schoolid, $userid);
          $inst->execute();
          // check user inserted, if so create login form
          if($inst->affected_rows==1) {
              echo"<p>Details inserted</p>";
              echo "<a href='index.php'>Click here to go home</a>";
          } else {
              echo "<p>Details not inserted</p>";
              echo "<a href='index.php'>Click here to go home</a>";
          }
          $inst->close();
          session_destroy();
      }
      else
      {
         echo "Is problem to find user"; 
         session_destroy();
      }     
  } 
  $stmt->close();
  $db->close();
  ?>
</body>
</html>