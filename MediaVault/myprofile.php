<?php

 	include "session.php";
    if ($_SESSION['location'] == ""){
        $_SESSION['location'] = $_SESSION["login_user"];
    }
    
    $result = mysql_query("SELECT * FROM user_id ");
    
    while($row = mysql_fetch_assoc($result)){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title></title>
	<script type="text/javascript" src="scripts.js"></script>
	<link type="text/css" rel="stylesheet" href="css/style.css" />
</head>
<body>
  <div id="demo">
	  <h2>User Profile
	  </h2>
  <div class="table-responsive-vertical shadow-z-1">
  <table id="table" class="table table-hover table-mc-light-blue">
      <tbody>
     	 <tr>
          <td class="bold" data-title="">User Name</td>
          <td id="userName" data-title="">
			<?php
					echo $row['user_name'];
			?>
			</td>
        </tr>
        <tr>
          <td class="bold" data-title="">Email Address</td>
          <td id="email" data-title="">
          	<?php
					echo $row['email_address'];
			?>
          </td>
          <td data-title="Edit">
            <a href="#" onclick="update_email()" target="_blank">Edit</a>
          </td>
        </tr>
        <tr>
          <td class="bold" data-title="">First Name</td>
          <td id="firstName" data-title="">
          	<?php
					echo $row['first_name'];
			?>
          </td>
          <td data-title="Edit">
            <a href="#" onclick="update_firstName()" target="_blank">Edit</a>
          </td>
        </tr>
        <tr>
          <td class="bold" data-title="">Last Name</td>
          <td id="lastName" data-title="">
          	<?php
					echo $row['last_name'];
			?>
          </td>
          <td data-title="Edit">
            <a href="#" onclick="update_lastName()" target="_blank">Edit</a>
          </td>
        </tr>
        <tr>
           <td data-title="">
            <a href="#" onclick="change_password()" target="_blank">Change Password</a>
          </td>
        </tr>
        <?php 
        	} 
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
