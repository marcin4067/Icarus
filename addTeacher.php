<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
$_SESSION['userid']=$userid;
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Teacher</title>
  
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
    <?php 
    $db=createConnection();
   	$sql = "select schoolid,schoolname from school;";
   	$stmt = $db->prepare($sql);   							
   	$stmt->execute();
   	$stmt->store_result();
   	$stmt->bind_result($schoolid,$schoolname);
   	if($stmt->num_rows>0)
   	    {
   		?>
   		<form name="choose" method="post" action="xAddTeacher.php">
   		   	<fieldset><legend>Add Teacher to School</legend>
   		    	<select name="classValue" id="classValue">
   			    <?php 
   			    while($row=$stmt->fetch()) 
   		       	{
   		       	    echo "<option id='firstName' name='firstName' value='$schoolid'> $schoolname  </option>";
   			    }
   				?>
   				</select>
				<button type="submit">Add</button>
			</fieldset>
		</form>
		<?php
	   }
	   else 
	   {
	       echo "<p>Schools no found!</p>";
		   
	   }
	   $stmt->close();
	   $db->close();
	?>
   </div>
 </div>
 <div class="row">   
   <div id="mainContent" class="col m8 offset-m3">    
   </div>
 </div>
</body>
</html>