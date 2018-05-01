<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Classes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/classes.css">
  <link rel="stylesheet" href="css/nav.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
  <?php include 'includes/nav.php';
  include "php/functions.php";
  if ($_SESSION['usertype']>0) 
  {  
  $db = createConnection();
  $sql = "select sessionid from user  where userid=?";
  $stmtl = $db->prepare($sql);
  $stmtl->bind_param("i",$_SESSION['userid']);
  $stmtl->execute();
  $stmtl->store_result();
  $stmtl->bind_result($sessionid);
  //$stmtl->store_result();
  if($stmtl== null)
  {
    echo "first login"  ;
  }
  ?>
   <div class="row">
     <div id="sidebar" class="col m2 blue darken-3">
       <h5 class="white-text">Classes</h5>
       <ul>
         <?php
           $db = createConnection();
           $query= "select classid from class;";
           $stmt = $db->prepare($query);
     	   $stmt->execute();
     	   $stmt->store_result();
           $stmt->bind_result($classid);
           while ($stmt->fetch()) 
           {
             echo '
             <li><a class="white-text" href="classes.html">Class '.$classid.'</a></li>
             ';
           }
           $stmt->close();
           $db->close();
         ?>
       </ul>
     </div>
   </div>
   <div class="row">
     <div class="col m8 offset-m3">
       <h3>Class 1</h3>
     </div>
     <div id="mainContent" class="col m8 offset-m3">
       <div class="row">
         <?php
           $db = createConnection();
           $query= "select firstname, lastname from user inner join classassigned on user.userid = classassigned.studentid where classid = ?;";
           $stmt = $db->prepare($query);
           $stmt->execute();
     	   $stmt->store_result();
           $stmt->bind_result($firstname,$lastname);
           $i = 0;
           while ($stmt->fetch()) 
           {
             echo '
             <div class="card col m2">
               <div class="card-image">
                 <img src="css/img/profile.png">
               </div>
               <div class="card-content">
                 <p>'.$firstname.' '.$lastname.'</p>
                 <p class="orange-text">75%</p>
               </div>
             </div>
             ';
             if ($i%5 == 0) 
             {
               echo '</div>';
             }
             else if ($i%6 == 0) 
             {
               echo '<div class="row">';
             }
             $i++;
           }
           $stmt->close();
           $db->close();
         ?>
        </div>
     </div>
   </div>
  <?php 
  }
  else 
  {
      ?>
   <p>You do not have access to view this page</p>
  <?php 
  }
  ?>
</body>
</html>
