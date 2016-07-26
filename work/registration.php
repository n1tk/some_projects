<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link href="style.css" rel="stylesheet" type="text/css">

<script>

function validate() {
//validation for the first name field
	var x = document.forms["form1"]["name"].value;
    if (x==null || x=="") {
        alert("First name must be filled out");	
		document.forms["form1"]["name"].focus();
        return false;			
    }	
// validation First Name only letters!!!
	var alphaExp = /^[a-zA-Z]+$/;
	if(x.match(alphaExp)){
	}else{
		alert("In the field First Name It can be only letters!!");
		document.forms["form1"]["name"].focus();
		return false;
	}
//validation for the last name field	
	var x = document.forms["form1"]["lastname"].value;
    if (x==null || x=="") {
        alert("Lastname must be filled out");
        document.forms["form1"]["lastname"].focus();
        return false;		
    }	
// validation Last Name only letters!!!
	var alphaExp = /^[a-zA-Z]+$/;
	if(!x.match(alphaExp)){
		alert("In the field Last Name It can be only letters!!");
		document.forms["form1"]["lastname"].focus();
		return false;
	}
//validation for the username
    var x = document.forms["form1"]["textfield"].value;
    if (x==null || x=="") {
        alert("CSENET Username must be filled out");
        document.forms["form1"]["textfield"].focus();		
        return false;		
    }	
// not numbers in the username	
	var alphaExp = /^[a-zA-Z]+$/;
	if(!x.match(alphaExp)){
		alert("In field CSENET UserName It can be only letters!!");
		document.forms["form1"]["textfield"].focus();
		return false;
	}
//at least 3 characters in username field	
	var x = document.forms["form1"]["textfield"].value;
    if (x.length<3) {
        alert("Entry must have at least 3 characters");
		document.forms["form1"]["textfield"].focus();
        return false;
    }
//email validation
	var x = document.forms["form1"]["email"].value;
    if (x==null || x=="") {
        alert("Email must be filled out");
		document.forms["form1"]["email"].focus();
        return false;
    }	
//validation services
var chk = form1.getElementsByClassName('services');
	var services = false;
	for (var i=0, length = chk.length; i<length; i++) {
     if (chk[i].type == 'checkbox') {
         if (chk[i].checked){    
                services = true;
         }
     }
	}
	if (services == false) {
	alert("You must select at least one service from Services Offered.");
		return false;
	}
//validation available day
var chk = form1.getElementsByClassName('day');
	var day = false;
	for (var i=0, length = chk.length; i<length; i++) {
     if (chk[i].type == 'checkbox') {
         if (chk[i].checked){    
                day = true;
         }
     }
	}
	if (day == false) {
	alert("You must select at least one day from Available Day.");
		return false;
	}

	//validation available time
var chk = form1.getElementsByClassName('time');
	var time = false;
	for (var i=0, length = chk.length; i<length; i++) {
     if (chk[i].type == 'checkbox') {
         if (chk[i].checked){    
                time = true;
         }
     }
	}
	if (time == false) {
	alert("You must select at least one time from Availabale time.");
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
  <?php
session_start(); 
if (!isset($_SESSION['authenticated']) OR !$_SESSION['authenticated'] == 1) { 
   	?>	
<p>To use this web site, you need to have valid CSENET credentials</p>
<a href="login.php">Login</a>
<?php     
	} 
else { 
     echo  '<P>Welcome, ' . $_SESSION["user"].'</P>';
	  
?> 
   <a href="logout.php">Logout</a>
 
      <h2>Registration Form</h2>
      <p><span class="error">* required field.</span></p>
<form id="form1" name="form1" method="post" onsubmit="return validate(this)" action= "registration_result.php"> 
        <p>
          <label for="name">First Name:</label>
          <input type="text" name="name" form= "form1" >
          <span class="error">*</span>
        </p>
        <p>
          <label for="lastname">Last Name:</label>
          <input type="text" name="lastname" form="form1" >
          <span class="error">*</span>
        </p>
        <p>
          <label for="textfield">CSENET Username:</label>
          <input name="textfield" type="text" id="textfield" form="form1"  >
          <span class="error">* </span>
        </p>
		
        <p></p>
        <p>
          <label for="email">Email:</label>
          <input name="email" type="email" id="email" form="form1"  >
          <span class="error">* </span>
        </p>
        <p>
          <label for="textfield2">Available day:</label>
		  <span class="error">*</span>
		  <p>
          <input type="checkbox" class = "day" name="day[]" value="monday" >
            Monday</label>
            <input type="checkbox" class = "day" name="day[]" value="tuesday">
            Tuesday</label>
            <input type="checkbox" class = "day" name="day[]" value="wednesday">
            Wednesday</label>
          <label>
            <input type="checkbox" class = "day" name="day[]" value="thursday">
            Thursday</label>
          <label>
            <input type="checkbox" class = "day" name="day[]" value="friday">
            Friday</label>
          <label>
            <input type="checkbox"  class = "day" name="day[]" value="saturday">
            Saturday</label>
          <label>
            <input type="checkbox" class = "day" name="day[]" value="sunday">
            Sunday</label> 
            
        
        </p>
        <p>
          <label>Availabale time:</label>
		  <span class="error">*</span>
        </p>
        <p>
          <input type="checkbox" class = "time" name="time[]" value="10am" >
            10am</label>
            <input type="checkbox" class = "time" name="time[]" value="11am">
            11am</label>
            <input type="checkbox" class = "time" name="time[]" value="12am">
            12am</label>
          <label>
            <input type="checkbox" class = "time" name="time[]" value="1pm">
            1pm</label>
          <label>
            <input type="checkbox" class = "time" name="time[]" value="2pm">
            2pm</label>
          <label>
            <input type="checkbox" class = "time" name="time[]" value="3pm">
            3pm</label>
          <label>
            <input type="checkbox" class = "time" name="time[]" value="4pm">
            4pm</label>
            <label>
            <input type="checkbox" class = "time" name="time[]" value="5pm">
            5pm</label>
            <label>
            <input type="checkbox" class = "time" name="time[]" value="6pm">
            6pm</label>
            
<br>
        </p>
        <p></p>
        <p>
          <label>Services offered:</label>
          <span class="error">*</span>
        </p>
        <?php
     $conn = new mysqli("localhost", "group5", 
            "my*password", "groupproject5");
			
      if (mysqli_connect_errno()){
          echo 'Cannot connect to database: ' . 
              mysqli_connect_error($conn);
      }
      else{
         echo "";
         $query = "SELECT * from services;";
         $result = mysqli_query($conn, $query);
         if (!$result) {
            die("Invalid query: " . mysqli_error($conn));
         }
         else {
            echo "";
            while($row = mysqli_fetch_array($result)){
                
                echo "<input type='checkbox' class = 'services' name='services[]' value='" . "{$row['serID']}". "' />{$row['desc_services']}<br />";
            }
echo "<br/>";
            mysqli_free_result($result);
         }
         mysqli_close($conn);
     }  
?>
        <p>
          <input type="checkbox" name="notification" form ="form1">
          <label for="notification">email notification </label>
        </p>
        <p>
          <input name="submit" type="submit" id="submit" form="form1" value="Submit"  >
        </p>
        <p></p>
        <p></p>
      </form>
      
  <?php
 }
 ?>     
 </section>
</div>
  <footer>
    Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA
  </footer>
</div>
</body>
</html>
  
