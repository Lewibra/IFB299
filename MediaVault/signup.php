<?php
   include("config.php");

   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $fname = mysqli_real_escape_string($db,$_POST['fname']);
      $lname = mysqli_real_escape_string($db,$_POST['lname']);
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $myusername = mysqli_real_escape_string($db,$_POST['uname']);
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']); 
      
      $sql = "SELECT id FROM users WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_row($result);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count != 1) {
         $sql = "INSERT INTO `users` VALUES (NULL, '$fname', '$lname', '$email', '$myusername', '$mypassword')";
         mysqli_query($db,$sql);

         header("location: index.php");
      }else {
         $error = "That username is taken";
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
    			<p>Signup</p>
  			</div>
        <p style="text-align: center; color: red;"><?= $error ?></p>
  			<div class="forgotblock">
          <input style="width: 45%; margin-right: 2%;" type="text" placeholder="First Name" name="fname" required>
          <input style="width: 45%; margin-left: 2%;" type="text" placeholder="Last Name" name="lname" required>
          <input type="text" placeholder="Email Address" name="email" required>
          <input type="text" placeholder="Username" name="uname" required>
    			<input type="password" placeholder="Password" name="psw" required>

    			<button id="subpass" type="submit">Submit</button>
  			</div>
		</form>
	</body>
</html>