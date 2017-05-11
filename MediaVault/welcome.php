<?php
   include('session.php');
?>
<html">  
   <head>
      <title>uDrop</title>
      	<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<script src="js/script.js"></script>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?></h1> 
      <button onclick="location.href='logout.php'" type="button">Logout</button>
   </body>  
</html>