<?php
    include "session.php";
    if ($_SESSION['location'] == ""){
        $_SESSION['location'] = $_SESSION["login_user"];
    }

	$sql = "SELECT * FROM user_id WHERE user_name = '" . $_SESSION["login_user"]."'";
    $result = $db->query($sql);
    while($row = $result->fetch_assoc()){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="CSS/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<title></title>
	<script type="text/javascript" src="js/scripts.js"></script>
	<link type="text/css" rel="stylesheet" href="CSS/style.css" />
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
            <a href="javascript:void(0);" onclick="update_email()">Edit</a>
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
            <a href="javascript:void(0);" onclick="update_firstName()">Edit</a>
          </td>
        </tr>
        <tr>
          <td class="bold" data-title="">Last Name</td>
          <td id="lastName" data-title="">
          	<?php
					echo $row['last_name'];
    					}
			?>
          </td>
          <td data-title="Edit">
            <a href="javascript:void(0);" onclick="update_lastName()">Edit</a>
          </td>
        </tr>
        <tr>
           <td data-title="">
            <a href="javascript:void(0);" onclick="change_password()">Change Password</a>
          </td>
        </tr>
      </tbody>
    </table>

  </div>
      <button class="w3-text-blue-gray" onclick="location.href='home.php'" type="button">Home</button>
      <button class="w3-text-blue-gray" onclick="location.href='logout.php'" type="button">Log Out</button>

  </div>
</body>
</html>
