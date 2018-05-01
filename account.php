<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/account.css">
  <link rel="stylesheet" href="css/nav.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
  <?php include 'includes/nav.php'; ?>
  <div class="row">
   <div class="col m8 offset-m2">
     <h3>Account Settings</h3>
   </div>
  </div>
  <div class="container">
   <div class="row">
     <div class="col m4 offset-m2 z-depth-1">
       <h5>Change Details</h5>
       <div class="input-field col m10 offset-m1">
         <input type="text" name="forename" id="forename">
         <label for="forename">Forename</label>
       </div>
       <div class="input-field col m10 offset-m1">
         <input type="text" name="surname" id="surname">
         <label for="surname">Surname</label>
       </div>
       <div id="email" class="input-field col m10 offset-m1">
         <input type="text" name="email">
         <label for="email">Email Address</label>
       </div>
       <a id="detailSubmit" href="#" class="col m4 offset-m4 btn btn-large blue">Submit</a>
     </div>
     <ul class="collection col m4 offset-m1 z-depth-1 form">
       <li class="collection-item">Example</li>
       <li class="collection-item">Example</li>
       <li class="collection-item">Example</li>
       <li class="collection-item">Example</li>
     </ul>
   </div>
  </div>
</body>
</html>
