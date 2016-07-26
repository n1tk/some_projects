<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Submission Results</title>
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
    <h2>Result</h2>
  <?php
  $conn = mysqli_connect("localhost", "group5", 
     "my*password", "groupproject5") 
     or die("Cannot connect to database:" . 
         mysqli_connect_error($conn));

  if (!empty($_POST['name'])) {
    $name = $_POST['name'];
    echo "<p>First name: $name </p>";
  } else {
    echo "<p>First name was not provided.</p>";
  }
  if (!empty($_POST['lastname'])) {
    $lastname = $_POST['lastname'];
    echo "<p>Last name: $lastname </p>";
  } else {
    echo "<p>Last name was not provided.</p>";
  }
  if (!empty($_POST['textfield'])) {
    $username = $_POST['textfield'];
    echo "<p>CSENET Username: $username </p>";
  } else {
    echo "<p>CSENET Username was not provided.</p>";
  }
  
  if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    echo "<p>Email: $email </p>";
  } else {
    echo "<p>Email was not provided.</p>";
  }
  
  if(isset($_POST['day'])){ 
    $day = implode(",", $_POST['day']);
    echo "<p>Available day: $day </p>";
  } else {
    echo "<p>Available day was not provided.</p>";
  }
  
  if(isset($_POST['time'])){ 
    $time = implode(",", $_POST['time']);
    echo "<p>Available time: $time </p>";
  } else {
    echo "<p>Available time was not provided.</p>";
  }
   if(!empty($_POST['services'])){ 
    $service = implode(",", $_POST['services']);
	echo "<p>Offered Services:</p>";
	foreach ($_POST['services'] as $services){
		$query = "SELECT * from services where serID = '$services';";
		$result = mysqli_query($conn, $query);
		while($row = mysqli_fetch_array($result)){
		echo $row['desc_services'];
		echo "<br>";
	}
	}
		if (!$result) {
		die("Invalid query: " . mysqli_error($conn));
		mysqli_stmt_close($query);						
	}
  } else {
    echo "<p>Services were not provided.</p>";
  }
  if (!empty($_POST['notification'])) {
	$notification = "YES";
	echo "<p>Notification Email: $notification </p>";
} else {
	$notification = "NO";
	echo "<p>Notification Email: $notification</p>";
}
   $msg = "Thank you for registration on our web site. ";
if(!empty($_POST["textfield"]) && !empty($_POST["email"]) && !empty($_POST["day"])&& !empty($_POST["time"])&& !empty($_POST["services"])&& !empty($_POST["name"])&& !empty($_POST["lastname"])) {  
 
	$query = mysqli_prepare($conn, 
"INSERT INTO profile (first_name, last_name, username, email, post_date, avail_date, avail_time, notification_email) VALUES(?, ?, ?, ?, NOW(), ?, ?, ?)")
     or die("Error: ". mysqli_error($conn));	 
	 mysqli_stmt_bind_param ($query, "sssssss", $name, $lastname, $username, $email,$day,$time,$notification);				
	 mysqli_stmt_execute($query)
       or die("Error. Could not insert into profile table." 
                   . mysqli_error($conn));	
	$inserted_id = mysqli_insert_id($conn);	   			   
   echo "<br>Your data was recorded into profile table<br>";
   mysqli_stmt_close($query);  
  
    foreach($_POST['services'] as $service) {
      $query = mysqli_prepare($conn, 
       "INSERT INTO services_provided(id_profile, serID) VALUES(?, ?)")
          or die("Error: ". mysqli_error($conn));
      mysqli_stmt_bind_param($query, "ss",$inserted_id, $service);
      mysqli_stmt_execute($query)
       or die("Error. Could not insert into services_provided table." 
                   . mysqli_error($conn));
      mysqli_stmt_close($query);
     }
	 echo "Your data was recorded into services_provided table<br><br>";

  if (!empty($_POST['notification']))  {  
  $to = $email;
  $subject = "Registration";
  $body = $msg;
								
 if (mail($to, $subject, $body)) {
  echo("<p>Confirmation email message successfully sent!</p>");
	
  } else {
   echo("<p>Confirmation email message delivery failed...</p>");	
 }  
 }
   
  $msg = $username . " (" . $email . ") " . $msg;
  
  
  
} else {
   $msg = "Return to registration page and fill out all required fields!";
}
  echo $msg;     

  ?>
</section>
</div>
 <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
  </body>
</html> 
