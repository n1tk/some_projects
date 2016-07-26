<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home Page</title>
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
session_start(); 
if (@!$_SESSION['authenticated'] == 1) {
?>
<p>To use this web site, you need to have valid CSENET credentials</p> 
<a href="login.php">Login</a>
<?php
}else {
?>
<td>
<?php
echo  '<P>Welcome, ' . $_SESSION["user"].'</P>';
?>
 <a href="logout.php">Logout</a>
 
<h2>Welcome to the TaskList website!!!</h2>

<p>Our group project is a 5-tier web application based on a user interface, a business logic layer, a data layer and a SQL server. 
Our project includes an Authentication for registration, profile changes and task manipulation. Registered users could also transfer tasks from their accounts to other user accounts. User also could mark completed tasks under their account.They also receive a notification email about the task been completed.</p>
<br>

	<h3>Group members:</h3>
	<ul>
	<li>Sergiu Buciumas</li> 
	<li>Julia Huprich</li> 
	<li>Jose Morales</li> 
	<li>Mfon Okpok</li> 
	<li>Olga Salomatova</li> 
	<li>Alyssa Stewart</li>
	</ul>

<?php
}
?>
    </section>
  </div>
  <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
</body>
</html>
