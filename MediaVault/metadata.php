<?php
	include("config.php");
	session_start();

	$mname = mysqli_real_escape_string($db,$_POST['metaname']);
	$mvalue = mysqli_real_escape_string($db,$_POST['metavalue']);

	$mstring = $mname . ',' . $mvalue . ';';



	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql = "INSERT INTO 'user_id' WHERE user_name = '" . $_SESSION["login_user"]."' ('metadata')
                VALUES ('CONCAT_WS(metadata, $mstring)')";
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
  			<div class="container">
    			<label><b>Metadata Label</b></label>
    			<input type="text" placeholder="Username" name="metaname" required>

    			<label><b>Value</b></label>
    			<input type="password" placeholder="Password" name="metavalue" required>
    			<button id="submit" type="submit" style="padding-left: 0; margin-left: 0; width: 100%">Apply</button>
  			</div>
		</form>
	</body>
</html>