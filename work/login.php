<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script>

	
function validate() {
	
    var x = document.forms["form1"]["username"].value;
    if (x==null || x=="") {
        alert("CSENET Username must be filled out");	
        return false;		
    }	
	var x = document.forms["form1"]["username"].value;
    if (x.length<3) {
        alert("Entry must have at least 3 characters");
        return false;
    }
	var x = document.forms["form1"]["password"].value;
    if (x==null || x=="") {
        alert("Password must be filled out");
        return false;
    }	
}


</script>

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
      <h2>Login to your account</h2> 
<form id="form1" name="form1" method="post" action= "loginresult.php"> 
        <p>
          <label for="username">CSENET Username:</label>
          <input type="text" name="username" form="form1">
        </p>
        <p>
          <label for="password">Password:</label>
          <input type="password" name="password" form="form1">
        </p>
		<p>
          <input name="submit" type="submit" id="submit" form="form1" value="Login"  onclick="validate()">
        </p>
      </form>   
</section>
</div>
  <footer>
    Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA
  </footer>
</div>
</body>
</html>
  
