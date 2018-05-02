<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
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
include 'includes/nav.php';
?>  
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
    
   </div>
 </div>
 <div class="row">
   
   <div id="mainContent" class="col m8 offset-m3">
    <?php 
    $teacherid=$_SESSION['userid'];
   // echo $userid;
   	$db=createConnection();
   	$sql = "select classid,classname from class where teacherid=?;";
   	$stmt = $db->prepare($sql);
   	$stmt->bind_param("i",$teacherid);
   	$stmt->execute();
   	$stmt->store_result();
   	$stmt->bind_result($classid,$classname);
   		if($stmt->num_rows>0)
   		{
   	    ?>
   	    <form name="choose" method="post" action="xAddStudent.php">
   	 	  	<fieldset><legend>Choose Class</legend>
   	 	  	<select name="classValue" id="classValue">
   		    <?php 
   	           while($row=$stmt->fetch()) 
        	   	{
        	   	    echo "<option value='$classid'> $classname  </option>";
   	        	}
       		?>
   			</select>
			<button type="submit">Add Students</button>
			</fieldset>
		</form>
		<?php
	}
	else 
	{
		echo "<p>No class found!</p>";
	}
	$stmt->close();
	$db->close();
	?>
     
   </div>
 </div>
</body>
</html>