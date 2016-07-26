<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>New task</title>
<link href="style.css" rel="stylesheet" type="text/css">
<script>
function validate() {
	var x = document.forms["form1"]["date"].value;
    if (x==null || x=="") {
        alert("Field Date must be filled out");
        return false;
    }	
var chosen = ""
var len = document.form1.select.length
for (i = 0; i <len; i++) {
if (document.form1.select[i].checked) {
chosen = document.form1.select[i].value
}
}
if (chosen == "") {
alert("You must select one provider!!")
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
	<h2>Post new task</h2>
      <form id="form1" name="form1" method="post" onsubmit="return validate()" action = "task_result.php">
        
          <label for="username">
          Username of the requesting user:</label>
		  <span class="error">*</span>
          <input name="username" type="text" value="<?php echo $_SESSION["user"] ?>" readonly>
		  
		  <p>
          <label for="date">Task Deadline:</label>
		  <span class="error">*</span>
          <input name="date" type="text" id="date" value= "<?php echo $_POST["date"] ?>" placeholder="yyyy-mm-dd" pattern="\d{4}[-]\d{2}[-]\d{2}" 
   title="Enter the date in this format: yyyy-mm-dd">
        </p>
		<p>
		<label for="task">
         Task description:</label>
		  <span class="error">*</span>
		  <input name="task" type="text" value="<?php
		$conn = mysqli_connect("localhost", "group5", 
     "my*password", "groupproject5") 
     or die("Cannot connect to database:" . 
         mysqli_connect_error($conn));
		 $service=$_POST['selectser'];
		 
		$query = "SELECT * from services where serID = '$service';";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
		echo $row['desc_services'];
	}
		if (!$result) {
		die("Invalid query: " . mysqli_error($conn));
		mysqli_stmt_close($query);						
	}
	?>" readonly>
        
		</p>
		
		<p>
		<label for="select">Select Provider:</label>
		  <span class="error">*</span>
		  </p>
		
	<div class = "table">	
	
<?php
				
$conn = new mysqli("localhost", "group5", 
            "my*password", "groupproject5");


      if (mysqli_connect_errno()){
          echo 'Cannot connect to database: ' . 
              mysqli_connect_error($conn);
      }
      else{
         echo "";
         
         $query = "select profile.id_profile, first_name, last_name, email, post_date, avail_date, avail_time, notification_email, services.serID, services.desc_services from services_provided inner join profile on profile.id_profile=services_provided.id_profile inner join services on services.serID = services_provided.serID where services.serID =".$_POST['selectser'].";";
		     
         $result = mysqli_query($conn, $query);
         
         if (!$result) {
            die("Invalid query: " . mysqli_error($conn));
         }
         else {
            
				
echo "<table border='1'>
<tr>
<th></th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Available day</th>
<th>Available Time</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>
  <td><input type='radio' name='select' value=".$row['id_profile']." </td>
  <td>".$row['first_name']." </td>
  <td>".$row['last_name']." </td>
  <td>".$row['email']." </td>
  <td>".$row['avail_date']." </td>
  <td>".$row['avail_time']."    </td>
  <tr>";
  
}
echo "</table>";          
echo "<br/>";          
            mysqli_free_result($result);
         }
         mysqli_close($conn);
     }
  ?> 
  </select>
        <p></p>
        <p>
          <input type="submit" name="submit"  id="submit" value="submit" form ="form1" >
        </p>
        <p></p>
        <p></p>
      </form>
	 <?php
 }
 ?>    
 </div>
    </section>
  </div>
  <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
</body>
</html>
