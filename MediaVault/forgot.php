<?php
   include("config.php");
   session_start();

   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['uname']);
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $firstName = mysqli_real_escape_string($db,$_POST['first']);
      $lastName = mysqli_real_escape_string($db,$_POST['last']);
      $mypassword = mysqli_real_escape_string($db,$_POST['psw']);
      
      $sql = "SELECT user_name FROM user_id 
              WHERE user_name = '".$myusername."' 
              AND email_address ='".$email."' 
              AND first_name='".$firstName."'
              AND last_name='".$lastName."'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_row($result);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
         $sql = "UPDATE users SET password='$mypassword' WHERE id='$row[0]'";
         mysqli_query($db,$sql);

         $_SESSION['login_user'] = $myusername;
         header("location: home.php");
      }else {
         $error = "Your Username does not exist";
      }
   }
?>
<html>
	<head>
		<title>MediaVault</title>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" href="CSS/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/script.js"></script>
	</head>
	<body>
		<h1>MediaVault</h1>
		<form action="" method="POST">
  			<div class="titlecontainer">
    			<p>Reset Password</p>
  			</div>
        <p style="text-align: center; color: red;"><?= $error ?></p>
  			<div class="forgotblock">
                <input type="text" placeholder="Your Username" name="uname" required>
                <input type="text" placeholder="Email Address" name="email" required>
                <input type="text" placeholder="First Name" name="first" required>
                <input type="text" placeholder="Last Name" name="last" required>
    			<input type="password" placeholder="New Password" name="psw" required>
    			<button id="subpass" type="submit">Submit</button>
  			</div>
		</form>
	</body>
</html>