<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="css/index.css">
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
</head>
<body>
  <div id="login" class="container">
    <form id="loginForm" action="login.php" method="post">
      <div class="row">
        <div class="blue col m4 offset-m4 z-depth-5">
          <h3 class="white-text">Icarus</h3>
        </div>
        <div id="loginForm" class="col m4 offset-m4 grey lighten-3 z-depth-5">
          <div class="input-field col m10 offset-m1">
            <input type="text" name="email" id="email">
            <label for="email">Email Address</label>
          </div>
          <div class="input-field col m10 offset-m1">
            <input type="password" name="userpass" id="password">
            <label for="password">Password</label>
          </div>
          <a id="submit" class="btn btn-large waves-effect waves-light blue col m4 offset-m4" onclick="submitForm()">Submit</a>
        </div>
      </div>
    </form>
  </div>
  <script src="js/index.js"> </script>
</body>
</html>
