<!doctype html>
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
      <h2>Post new task</h2>
      <form id="form1" name="form1" method="post" action = "providers.php">
        
          <label for="username">
          Username of the requesting user:</label>
		  <span class="error">*</span>
          <input name="username" type="text" value="<?php echo $_SESSION["user"] ?>" readonly>
		  
		  <p>
          <label for="date">Task Deadline:</label>
		  <span class="error">*</span>
          <input name="date" type="text" id="date"  placeholder="yyyy-mm-dd" pattern="\d{4}[-]\d{2}[-]\d{2}" 
   title="Enter the date in this format: yyyy-mm-dd">
   
        </p>
         
         <label>Select the service to see all providers:</label>
          <span class="error">*</span>
        
        <select id="selectser" name= "selectser">
      
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
                
                echo "<OPTION VALUE='".$row['serID']."'>".$row['desc_services']."</OPTION>";  
            }
echo "<br/>";
            mysqli_free_result($result);
         }
         mysqli_close($conn);
     }  
?>
</select>   
<p><input type="submit" name="submit" form = "form1" id="submit" value="show" ></p>
       
   
      </form>
	  <?php
 }
 ?>  
    </section>
  </div>
  <footer>Copyright &copy; 2014 Southern Polytechnic State University, 1100 South Marietta Parkway, Marietta, GA</footer>
</div>
</body>
</html>
