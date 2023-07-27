<?php
  
?>

<!--Has the html for the login itself -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <title>Login/Signup Page</title>
</head>
<body>
  <div class="wrapper">
    <h1>Login</h1>
    <form action="login/login.php" method="POST"> <!-- Corrected the action attribute -->
      <input type="text" name="username" placeholder="Username" />
      <input type="password" name="password" placeholder="Password" />
      <button type="submit">Login</button>
    </form>
    <div class="member">
      Not a member? <a href="./signup.html"> Sign up Here! </a>
    </div>
  </div>
</body>
</html>