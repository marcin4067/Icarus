<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
$_SESSION['userid']=$userid;
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin</title>
  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
  <link rel="stylesheet" href="css/index.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  
</head>
<body>
<?php
include 'includes/nav.php';
?>   
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
     <h5 class="white-text">Classes</h5>
     <ul>     
       <li><a class="white-text" href=addQuestion.php>Add Question</a></li>      
       <li><a class="white-text" href="addAnswer.php">Add Answer</a></li>  
	   <li><a class="white-text" href=addTeacher.php>Add Teacher</a></li>      
       <li><a class="white-text" href="addModule.php">Add Module</a></li> 	   
     </ul>
   </div>
 </div>
 <div class="row">
   
   <div id="mainContent" class="col m8 offset-m3">
    
    
   </div>
 </div>
</body>
</html>