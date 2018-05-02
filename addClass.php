<?php session_start(); 
include("php/functions.php");
?>
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
<?php
include 'includes/nav.php';
?>  
   <div class="row">
     <div id="sidebar" class="col m2 blue darken-3">
       <h5 class="white-text">Classes</h5>
       <ul>
        <?php          
          $classname=$_POST['className'];
          $teacherid=$_SESSION['userid'];
          
          $db=createConnection();
          //Create query, note that parameters being passed in are represented by question marks
          $classsql="select classid from class where classname=? and teacherid=?;";
          $stmt = $db->prepare($classsql);
          $stmt->bind_param("si",$classname,$teacherid);
          //Run query
          $stmt->execute();
          //Store Query Result
          $stmt->store_result();
          //Bind returned row parameters in same order as they appear in query
          $stmt->bind_result($classid);
          //Valid classid only if exactly one row returned, otherwise something iffy is going on
          if ($stmt->num_rows>0)
          {
              echo "Class exist";
          }
          else
          {
              // insert new class
              $insertquery="insert into class (classname, teacherid) values (?,?);";
              $inst=$db->prepare($insertquery);
              $inst->bind_param("si", $classname, $teacherid);
              $inst->execute();
              // check class inserted
              if($inst->affected_rows==1) 
              {
                  echo"Class added properly";
                  ?>
                  <div class="row">
    				 <div class="col m8 offset-m3">
   					    <h3><?php echo $classname; ?></h3>   					    
   					     <ul> 
					 	   <li><a class="white-text" href="addStudent.php">Add Student</a></li>        
      					   <li><a class="white-text" href="addModule.php">Add Module</a></li> 	   
    					 </ul>
   					 </div>
     				 <div id="mainContent" class="col m8 offset-m3">
          			 <div class="row">       					
        			 </div>
     				 </div>
   				  </div>
                  <?php
              }
              else 
              {
                  echo"Class not added ";
              }
              $inst->close();
          }
          $stmt->close();
          $db->close();
          ?>          
       </ul>
     </div>
   </div>     
</body>
</html>
