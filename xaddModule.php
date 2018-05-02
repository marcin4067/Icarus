<!DOCTYPE html>
<?php 
session_start();
//include('includes/menu.php');
include('php/functions.php');
//include('php/functions2.php');

session_start(); 
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Unit</title>
  
  <link rel="stylesheet" href="css/addUnit.css"/>   
  <link rel="stylesheet" href="css/nav.css"/>    
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
   		<div class="form-group">
   		<?php 
   		$moduleName=$_POST['addModule'];
   		$level=$_POST['level'];
   		  	
   		
   		$db = createConnection();
   		
   		$sql ="select moduleid from module where  `modulename`=? and `level`=?;";
   		$stmt=$db->prepare($sql);
   		$stmt->bind_param("ss", $moduleName,$level);
   		$stmt->execute();
   		$stmt->store_result();
   		$stmt->bind_result($moduleid);
   		if ($stmt->num_rows != 0) 
   		{
   		    echo "That module exist";
   		}
   		else 
   		{
   		    $insertquery="INSERT INTO module(`modulename`,`level`) VALUES (?,?);";
   		    $inst=$db->prepare($insertquery);
   		    $inst->bind_param("ss",  $moduleName,$level);
   		    $inst->execute();
   		    if($inst->affected_rows==1)
   		    {
   		        echo "Module added properly";
   		    }
   		    else
   		    {
   		        echo "is problem to add data";
   		    }
   		    $inst->close();
   		}
   		$stmt->close();
   		$db->close();
   		?>	
   		</div>	    
   </div>			
 </div>
</body>
</html>