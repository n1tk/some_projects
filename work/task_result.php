<html>
<head>
<meta charset="utf-8">
<title>New task</title>
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
	
<h2>Result</h2>
  <?php
  $conn = mysqli_connect("localhost", "group5", 
     "my*password", "groupproject5") 
     or die("Cannot connect to database:" . 
         mysqli_connect_error($conn));

  if (!empty($_POST['username'])) {
    $requser = $_POST['username'];
    echo "<p>Username of the requesting user: $requser </p>";
  } else {
    echo "<p>Username of the requesting user was not provided.</p>";
  }
  $query = "SELECT * from profile where username = '$requser';";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
		$requser1= $row['id_profile'];
	}
		if (!$result) {
		die("Invalid query: " . mysqli_error($conn));
		mysqli_stmt_close($query);						
	}
  
  if (!empty($_POST['select'])) {
    $provider = $_POST['select'];
    echo "Username of provider:";
	$query = "SELECT * from profile where id_profile = '$provider';";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
		$provider1=$row['username'];
		echo $row['username'];
		$email=$row['email'];
	}
		if (!$result) {
		die("Invalid query: " . mysqli_error($conn));
		mysqli_stmt_close($query);						
	}
  } else {
    echo "<p>Username of provider was not provided.</p>";
  }
  
    if (!empty($_POST['task'])) {
    $task = $_POST['task'];
    echo "<p>Task Description: $task </p>";
  } else {
    echo "<p>Task Description was not provided.</p>";
  }
  $query = "SELECT * from services where desc_services = '$task';";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
		$task1= $row['serID'];
	}
		if (!$result) {
		die("Invalid query: " . mysqli_error($conn));
		mysqli_stmt_close($query);
		
	}

  if (!empty($_POST['date'])) {
    $date = $_POST['date'];
    echo "<p>Task deadline: $date </p>";
  } else {
    echo "<p>Task deadline was not provided.</p>";
  }
  
  
  $msg1 = "You assigned your task!!!Assigned person will get email notification ";
  $msg2 =   $requser ."assigned for" . $task;
if (!empty($_POST["username"]) && !empty($_POST["select"]) && !empty($_POST["task"])&& !empty($_POST["date"])) {  
 
	$query = mysqli_prepare($conn, 
"INSERT INTO tasks (id_profile1, id_profile2, serID, deadline) VALUES(?, ?, ?, ?)")
     or die("Error: ". mysqli_error($conn));	 
	 mysqli_stmt_bind_param ($query, "ssss", $requser1, $provider, $task1, $date);				
	 mysqli_stmt_execute($query)
       or die("Error. Could not insert into tasks table." 
                   . mysqli_error($conn));		   			   
   echo "<br>Your data was recorded into tasks table<br>";
   mysqli_stmt_close($query);  
   
   
  $to = $email;
  $subject = "Assign task";
  $body = $msg2;								
 if (mail($to, $subject, $body)) {
  echo("<p>Confirmation email message successfully sent !</p>");	
  } else {
   echo("<p>Confirmation email message delivery failed...</p>");	 
 }

 
}

 else {
   $msg1 = "Return to post new task page and fill out all required fields!";
}
  echo $msg1;     
  ?>
  
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
