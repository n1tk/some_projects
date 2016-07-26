<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Search Results</title>
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
    <h2>Search Result</h2>
    <?php
				
$conn = new mysqli("localhost", "group5", 
            "my*password", "groupproject5");


       if (mysqli_connect_errno()){
          echo 'Cannot connect to database: ' . 
              mysqli_connect_error($conn);
      }
      else{
	  echo "";
         
         $query = "select first_name, last_name, email, post_date, avail_date, avail_time, notification_email, services.serID, services.desc_services from services_provided inner join profile on profile.id_profile=services_provided.id_profile inner join services on services.serID = services_provided.serID where services.serID =".$_POST['selectser'].";";
		     
         $result = mysqli_query($conn, $query);
         
         if (!$result) {
            die("Invalid query: " . mysqli_error($conn));
         }
         else {
            echo "Providers and their availability<br><br>";
				
echo "<table align='center' border='1'>
<tr>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Available date</th>
<th>Available Time</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['first_name'] . "</td>";
  echo "<td>" . $row['last_name'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "<td>" . $row['avail_date'] . "</td>";
  echo "<td>" . $row['avail_time'] . "</td>";
  echo "</tr>";
}
echo "</table>";          
echo "<br/>";        

   
         //read keyword from user
         if(!empty($_POST["keyword"])){
            $keyword = "%".$_POST["keyword"]."%"; 
         
           // create prepared statement 
           if ($query = mysqli_prepare($conn, 
          "SELECT first_name, last_name, email, post_date, avail_date, avail_time FROM profile WHERE UPPER(first_name) LIKE ? or UPPER (last_name) LIKE ? or UPPER (email) LIKE ? or UPPER (post_date) LIKE ? or UPPER (avail_date) LIKE ? or UPPER (avail_time) LIKE ? ")) {

	       // bind parameters  SAMPLE TEST (cont)
	       mysqli_stmt_bind_param ($query, "ssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);
             
            //run the query and keep results in $result variable
            mysqli_stmt_execute($query);

            // bind variables to prepared statement 
            mysqli_stmt_bind_result($query, $first_name, $last_name, $email, $post_date, $avail_date, $avail_time);

            //fetch values 
            while (mysqli_stmt_fetch($query)) {
                 echo "<strong>$last_name, $first_name</strong> E-mail: $email<br/>Post Date: $post_date, Available days: $avail_date, At: $avail_time <br/><br/>";
             }
			 
			 
		/*	$result = mysqli_query($conn, $query);
			
			echo "<table align='center' border='1'>
				<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Available date</th>
				<th>Available Time</th>
				</tr>";
			
			while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['first_name'] . "</td>";
			echo "<td>" . $row['last_name'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>" . $row['post_date'] . "</td>";
			echo "<td>" . $row['avail_date'] . "</td>";
			echo "<td>" . $row['avail_time'] . "</td>";
			echo "</tr>";
			}
*/			
			echo "</table>";
           //free memory used by a result handle 
	        mysqli_stmt_close ($query);
            } else //problem with a query
              echo "Error: " . mysqli_error($conn);
          } else { //no keyword 
              echo "No keyword was specified";
          }
		 
		 //
		 
         mysqli_close($conn);
     }
	 }
  ?> 
  </section>
</div>
 <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
  </body>
</html> 
