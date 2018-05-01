<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Students</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/students.css">
  <link rel="stylesheet" href="css/nav.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
  <?php include 'includes/nav.php'; ?>
  <div class="row">
   <div class="col m8 offset-m2">
     <h3>Students</h3>
   </div>
   <div id="mainContent" class="col m8 offset-m2">
     <div class="row">
     <?php
       include "php/functions.php";
       $db = createConnection();
       $query= "select firstname, lastname from student";
       $stmt = $db->prepare($query);
 	   $stmt->execute();
 	   $stmt->store_result();
       $stmt->bind_result($firstname,$lastname);
       $i = 0;
       while ($stmt->fetch()) {
         echo '
         <div class="card col m2">
           <div class="card-image">
             <img src="css/img/profile.png">
           </div>
           <div class="card-content">
             <p>'.$firstname.' '.$lastname.'</p>
           </div>
         </div>
         ';
         if ($i%5 == 0) {
           echo '</div>';
         } else if ($i%6 == 0) {
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
</body>
</html>
