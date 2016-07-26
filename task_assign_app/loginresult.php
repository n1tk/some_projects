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
@session_start(); 
session_regenerate_id();
if (!isset($_SESSION['authenticated'])) {
      $_SESSION['authenticated'] = 0;
}
if(empty($_POST["username"]) || empty($_POST["password"])) die("Username and password are required");
$username = $_POST["username"];
$password = $_POST["password"];
$ad = ldap_connect("ldap://192.168.70.60") or die("Couldn't connect to CSENET");

@$bd = ldap_bind($ad,"$username@csenet.spsu.edu",$password) or
die("Authentication failed.");
    if ($bd) {
      $_SESSION["authenticated"] = 1; 
      $_SESSION["user"] = $username; 	 
	  }	
 if (!$bd) {	
    $_SESSION['authenticated'] = 0;
?>	
<p>To use this web site, you need to have valid CSENET credentials</p> 
<?php      
}
else {

echo  '<P>Welcome, ' . $_SESSION["user"].'</P>';
}
?>
   <a href="logout.php">Logout</a>

</section>
</div>
 <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
  </body>
</html> 