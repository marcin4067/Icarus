<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
$_SESSION['userid']=$userid;
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Teacher</title>
  <!--
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">  
  <link rel="stylesheet" href="css/index.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  -->
</head>
<body>
<?php
// menus();
//echo $studentid;
?>   
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
     <?php 
     $schoolid=$_POST['classValue'];
     ?>
    <form id="xAddTeacher" name="xAddTeacher" method="post" action="xxAddTeacher.php">
			<fieldset><legend>Teacher details</legend>
				<div>
					<table>
						<tr >							
							<td >
  					 		  <div class="col-25">
    							 <input type="text" placeholder="First Name*" id="firstName" name="firstName" required size="25" /><span id="firstNameFb"></span>
     				   		  </div>	
    				 		  <div class="col-25">	
    							 <input type="text" placeholder="Last Name*" id="lastName" name="lastName" required size="25" /><span id="lastNameFb"></span>
    				  		  </div>
    				  		  <div class="col-25">	
    							 <input type="text" placeholder="Email*" id="email" name="email" required size="25" /><span id="emailFb"></span>
    				  		  </div>	
    				  		  <div class="col-25">	
    							 <input  hidden  type="text" id="schoolid" name="schoolid" value="<?php echo $schoolid; ?>" />
    				  		  </div>	
    				  		  
    				   	 <div class="col-25">	
							 <div id="submitbutton">	
								<button type="reset">Reset</button><button id="submitb" type="submit">Save</button>
							 </div>
					    </div>	
   						</td>
						</tr>	
     				</table>							
				</div>
			</fieldset>
		</form>
   </div>
 </div>
 <div class="row">
   
   <div id="mainContent" class="col m8 offset-m3">
    
    
   </div>
 </div>
</body>
</html>