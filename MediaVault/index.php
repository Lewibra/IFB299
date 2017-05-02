<?php
   include("config.php");
   session_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['user_name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      
      $sql = "SELECT user_name FROM user_id WHERE user_name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $_SESSION['login_user'] = $myusername;
         header("location:home.php", true, 301);
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<!DOCTYPE html>
<html>
	<head>
        <title>Media Vault</title>
        <link rel="stylesheet" href="CSS/w3.css">
		<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
		<script src="js/script.js"></script>
	</head>
	<body>
		<h1>MediaVault</h1>
        <div class="w3-center"><img src="Images/vault.png" style="width:5%;">
        </div>
        <form action="" method="POST">
  			<div class="titlecontainer">
    			<p>Login</p>
  			</div>
        <p style="text-align: center; color: red;"><?= $error ?></p>
  			<div class="container">
    			<label><b>Username</b></label>
    			<input type="text" placeholder="Username" name="user_name" required>

    			<label><b>Password</b></label>
    			<input type="password" placeholder="Password" name="password" required>

    			<button onclick="location.href='sipnup.html'" type="button">Signup</button>
    			<button type="submit">Login</button>
  			</div>
		</form>
	</body>
</html>