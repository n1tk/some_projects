<html>
  <head>
    <title>Display Records</title>
  </head>
  <body>
    <?php
      $conn = new mysqli("localhost", "group5", 
     "my*password", "groupproject5");
      if (mysqli_connect_errno()){
          echo 'Cannot connect to database: ' . 
              mysqli_connect_error($conn);
      }
      else{
         if(!empty($_POST["keyword"])){
            $keyword = "%".$_POST["keyword"]."%"; 
           if ($query = mysqli_prepare($conn, 
          "SELECT profile.first_name, last_name, email, avail_date, avail_time, services.desc_services from services_provided inner join profile on profile.id_profile=services_provided.id_profile inner join services on services.serID = services_provided.serID WHERE UPPER(desc_services) LIKE ?")) {

	       mysqli_stmt_bind_param ($query, "s", $keyword);
          
            mysqli_stmt_execute($query);

            mysqli_stmt_bind_result($query, $first_name, $last_name, $email, $avail_date, $avail_time, $desc_services);
			
            while (mysqli_stmt_fetch($query)) {
                 echo "<strong>service: $desc_services</strong> <br/> $first_name $last_name</br> email: $email, available day: $avail_date, available time: $avail_time <br/><br/>";
             }
	        mysqli_stmt_close ($query);
            } else 
              echo "Error: " . mysqli_error($conn);
          } else {  
              echo "No keyword was specified";
          }
         
         mysqli_close($conn);
     }
?>
  </body>
</html>
