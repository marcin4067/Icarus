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
//menus();
?>   
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">     
   </div>
 </div>
 <div class="row">   
   <div id="mainContent" class="col m8 offset-m3">
   		<div class="form-group">
   		<form id="addModule" name="addModule" method="post" action="xaddModule.php">
			<fieldset><legend>Add Class Details</legend>
				<div>
					<table>
						<tr id="">							
							<td id="leftdata">							
								<div class="col-25">
									<input type="text" placeholder="Module name*" id="addModule" name="addModule" required size="25" /><span id="addModuleFb"></span>
								</div>
								<div class="col-25">
									<input type="text" placeholder="Level*" id="level" name="level" required size="25" /><span id="levelFb"></span>
								</div>
								
								
								<div class="col-25">	
									<div id="submitbutton">	
										<button type="reset">Reset</button><button id="submitb" type="submit">Add Module</button>
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
 </div>
</body>
</html>