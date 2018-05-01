<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>

</head>
<body>
    <form action="registerResult.php" id="registerForm" method="post">
      <fieldset>
        <h1>Register</h1>
        <h2>Email</h2>
        <input id="registerEmail" name="email" type="text">
        <h2>Username</h2>
        <input id="registerUsername" name="username" type="text">
        <h2>Forename</h2>
        <input id="registerForename" name="forename" type="text"><br />
        <h2>Surname</h2>
        <input id="registerSurname" name="surname" type="text"><br />
        <h2>Password</h2>
        <input id="registerPassword1" name="userpass" type="password"><br />
        <h2>Password - Confirm</h2>
        <input id="registerPassword2" name="userpass2" type="password"><br />
        <button>Submit</button>
      </fieldset>
    </form>
</body>
</html>
