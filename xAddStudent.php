
<!DOCTYPE html>
<?php session_start(); 
//include('includes/menu.php');
include('php/functions.php');
//include('php/functions2.php');
$_SESSION['userid']=$userid;
$teacherid=$_SESSION['userid'];
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
//echo $teacherid.' '.$userid;
?>  
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
    
   </div>
 </div>
 <div class="row">
   <div id="sidebar" class="col m2 blue darken-3">
    <?php 
    $db=createConnection();
   	$sql = "SELECT moduleid, modulename , level from module;";
   	$stmt = $db->prepare($sql);   							
   	$stmt->execute();
   	$stmt->store_result();
   	$stmt->bind_result($moduleid,$modulename,$level);
   	if($stmt->num_rows>0)
   	    {
   		?>
   		<form id="xAddStudent" name="xAddStudent" method="post" action="xxAddStudent.php">
			<fieldset>
				<table>
					<tr>
						<td>
							<label for="studentemail"> Student details: </label>
							<input type="text" placeholder="Email*" id="email" name="email" required size="25" /><span id="emailFb"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="adultNo"> Module </label>
								<select name="module" id="module">
								<?php 
									while($row=$stmt->fetch()) 
									{
										echo "<option id='module' name='module' value='$moduleid'> $modulename  / $level </option>";
									}
								?>
								</select>
								<button type="reset">Reset</button><button id="submitb" type="submit">Save</button>
						</td>
					</tr>	
				</table>	
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
</body>
</html>