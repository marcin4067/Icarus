<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Create Account</title>
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
  $email=$_GET['dID'];
 
  $db = createConnection();
  $sql = "select userid, sessionid, utype, xp, schoolid from user  where email=?";
  $stmt = $db->prepare($sql);
  $stmt->bind_param("s",$email);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($userid, $sessionid, $utype, $xp, $schoolid);  
  while($row=$stmt->fetch()) 
  {
      
      if($stmt-> num_rows()== 1)
      {
          
          if($sessionid != "a" || $sessionid == null)
          {
              echo " You should't be on this page, please contact with administrator";
          }
          else 
          {
             
          ?>
  			 <div class="row">
     			<div id="sidebar" class="col m2 blue darken-3">
       				<h5 class="white-text">Create Account</h5>
     			</div>
   			</div>
   			<div class="row">     			
     			<div id="mainContent" class="col m5 offset-m3">
					<form action="xfirstTime.php" id="registerForm" method="post">
						<h6>Register</h6>
      						<fieldset>        
        						<h6>Email</h6>
        						<input id="registerEmail" name="email" type="text">
        						<h6>Username</h6>
        						<input id="registerUsername" name="username" type="text">
        						<h6>Forename</h6>
        						<input id="registerForename" name="forename" type="text"><br />
        						<h6>Surname</h6>
        						<input id="registerSurname" name="surname" type="text"><br />
        						<h6>Password</h6>
        						<input id="registerPassword1" name="userpass" type="password"><br />
        						<h6>Password - Confirm</h6>
        						<input id="registerPassword2" name="userpass2" type="password"><br />
        						<input type = hidden id="userid" name="userid" value = "<?php echo $userid; ?>" ><br />
        						<input type = hidden id="utype" name="utype" value = "<?php echo $utype; ?>" ><br />
        						<input type = hidden id="xp" name="xp" value = "<?php echo $xp; ?>" ><br />
        						<input type = hidden id="schoolid" name="schoolid" value = "<?php echo $schoolid; ?>" ><br />
                				<button>Submit</button>
      						</fieldset>
    				</form>
     			</div>
   			</div>
  		<?php
      }
      
   }    
   
   else
   {
      echo "Is problem to find user";    
   }     
  }
  $stmt->close();
  $db->close();
  ?>
</body>
</html>