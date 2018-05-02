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
include 'includes/nav.php';
?>  
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
    
   </div>
 </div>
 <div class="row">
   
   <div id="mainContent" class="col m8 offset-m3">
    <?php 
    $classValue=$_POST['classValue'];	
    //echo $userid;
    ?>
     <form id="xAddStudent" name="xAddStudent" method="post" action="xxAddStudent.php">
			<fieldset><legend>Student details</legend>
				<div>
					<table>
						<tr id="">
							
							<td id="leftdata">
							<!--<div class="col-25">
									<input type="text" placeholder="account No*" id="accountNo" name="accountNo" required size="25" /><span id="accountNoFb"></span>
								</div> -->
								<div class="col-25">
									<input type="text" placeholder="Email*" id="email" name="email" required size="25" /><span id="emailFb"></span>
								</div>									
							</td>
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
</body>
</html>