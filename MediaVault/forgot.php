<?php
   include("config.php");
   session_start();

   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['uname']);
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
      
      $sql = "SELECT id FROM users WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_row($result);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $sql = "UPDATE users SET password='$mypassword' WHERE id='$row[0]'";
         mysqli_query($db,$sql);

         $_SESSION['login_user'] = $myusername;
         header("location: welcome.php");
      }else {
         $error = "Your Username does not exist";
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
    			<p>Reset Password</p>
  			</div>
        <p style="text-align: center; color: red;"><?= $error ?></p>
  			<div class="forgotblock">
          <input type="text" placeholder="Your Username" name="uname" required>
    			<input type="password" placeholder="New Password" name="psw" required>
    			<button id="subpass" type="submit">Submit</button>
  			</div>
		</form>
	</body>
</html>