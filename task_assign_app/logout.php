<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
  <header>TaskList</header>
  <?php include "menu.php"; ?>
  <div class="content">
  <section>
 <?php include "menu1.php"; ?>
  </section>
  <section>
<?php

$_SESSION = array();

if (isset($_COOKIE[session_name("PHPSESSID")])) {
    setcookie(session_name("PHPSESSID "), '', time()-42000, '/');
@session_destroy();
?>
 <a href="login.php">Login</a>
<?php
}
?>
  



</section>
</div>
 <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
  </body>
</html> 