<?php
include("config.php");
session_start();

$fiileLocation = parse_str($_SERVER['QUERY_STRING']);

?>
<html>
<head>
    <script src="./js/epub.min.js"></script>
</head>

<body>

<div onclick="Book.prevPage();">‹</div>
<div id="area"></div>
<div onclick="Book.nextPage();">›</div>

<script>
    var path = <?php echo json_encode($fiileLocation); ?>;
    var Book = ePub(path);
    Book.renderTo("area");

</script>
</body>
</html>