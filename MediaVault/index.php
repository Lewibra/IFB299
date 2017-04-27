<!DOCTYPE html>
<?php
   include("config.php");
   session_start();

   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['uname']);
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
      
      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
	<head>
		<title>uDrop</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script src="js/script.js"></script>
	</head>
	<body>
		<h1>uDrop</h1>
		<form action="" method="POST">
  			<div class="titlecontainer">
    			<p>Login</p>
  			</div>
        <p style="text-align: center; color: red;"><?= $error ?></p>
  			<div class="container">
    			<label><b>Username</b></label>
    			<input type="text" placeholder="Username" name="uname" required>

    			<label><b>Password</b></label>
    			<input type="password" placeholder="Password" name="psw" required>

    			<button onclick="location.href='sipnup.html'" type="button">Signup</button>
    			<button type="submit">Login</button>
  			</div>
		</form>
	</body>
</html>