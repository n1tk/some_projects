<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Search Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
    var xmlReq;
    function processResponse(){
       if(xmlReq.readyState == 4){
           var place = document.getElementById("placeholder");
           place.innerHTML = xmlReq.responseText
      }
    }
 
   function loadResponse(){
      // create an instance of XMLHttpRequest 
      xmlReq = new XMLHttpRequest();
      xmlReq.onreadystatechange = processResponse;

      //call server_side.php
      xmlReq.open("POST", "search_result.php", true);

      //read value from the form
      // encodeURI is used to escaped reserved characters
      parameter = "keyword=" + encodeURI(document.forms["form1"].keyword.value);

      //send headers
      xmlReq.setRequestHeader("Content-type", 
                  "application/x-www-form-urlencoded");
      xmlReq.setRequestHeader("Content-length", parameter.length);
      xmlReq.setRequestHeader("Connection", "close");

      //send request with parameters
      xmlReq.send(parameter);
      return false;
   }
   function check(){
 if(!document.forms["form1"].keyword.value=="") {   
     return true;
   }else{
  alert("no keyword provided");
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
    <h2>Search</h2>
	<form name="form1" method="post" action="search_result.php" >
<p> Select service that you need </p> 
       <p>
       Offered Service:
      <select id="selectser" name= "selectser" onblur="">
      
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
      
      </p>
       <p>
          <input name="submit" type="submit" id="submit" form="form1" value="Submit">
        </p>
		<form method="POST" name="form1" action="search_result.php" onkeyup="return loadResponse();" onsubmit="return check();">
         Search for records by user name: <input type="text" name="keyword">
		 <input type="submit" value="Search" onsubmit="return check();">
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