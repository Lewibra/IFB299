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
      
      $sql = "SELECT user_name FROM user_id WHERE user_name = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_row($result);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count != 1) {
         $sql = "INSERT INTO `user_id` VALUES ('$myusername',  '$email', '$mypassword', '$fname', '$lname')";
         mysqli_query($db,$sql);
         if (!file_exists('./mediavault_files/users/'.$_POST['uname'])) {
             mkdir('./mediavault_files/users/'.$_POST['uname'], 0777, true);
         }
         header("location: index.php");
      }else {
         $error = "That username is taken";
      }
   }
?>
<html>
	<head>
		<title>MediaVault</title>
        <link rel="stylesheet" href="CSS/w3.css">
        <link rel="stylesheet" type="text/css" href="CSS/style.css"/>
		<script src="./js/script.js"></script>
	</head>
	<body>
     <div class="w3-center"><img src="Images/icons/MediaVaultlogo.png" style="width:30%;">
        <form action="" method="POST">
    			<h2>Signup</h2>
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

<body>