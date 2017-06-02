<?php
    include "session.php";
    if ($_SESSION['location'] == ""){
        $_SESSION['location'] = $_SESSION["login_user"];
    }
    echo $_SESSION['location'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="./CSS/dropzone.css" />


</head>
<title>MediaVault</title>
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container">
        <a href="#" onclick="side_bar_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
            <i class="fa fa-remove"></i>
        </a>
        <img src="Images/icons/MediaVaultlogo2.png" style="width:55%;" class="w3-round"><br><br>
        <h4 class="w3-text-blue-gray"><b>MediaVault</b></h4>
        <p class="w3-text-grey">Lewis Tracy</p>
    </div>
    <div class="w3-bar-block">
        <a href="#myfiles" onclick="side_bar_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right w3-text-blue-gray"></i>MY FILES</a>
        <a href="./myprofile.php" onclick="side_bar_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right w3-text-blue-gray"></i>ABOUT</a>
        <a href="javascript:void(0);" onclick="log_out()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right w3-text-blue-gray"></i>LOG OUT</a>

    </div>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="side_bar_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

    <!-- Header -->
    <header id="myfiles">
        <a href="#"><img src="/w3images/avatar_g2.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="side_bar_open()"><i class="fa fa-bars"></i></span>
        <div class="w3-container">
            <h1 class="w3-text-blue-gray"><b>My Files</b></h1>
            <div class="w3-section w3-bottombar w3-padding-16">

                <span class="w3-margin-right w3-text-blue-gray">Sort By:</span>
                <button href="javascript:void(0);" onclick="sort_name()" class="w3-button w3-white w3-text-blue-gray"><i class="fa fa-file w3-margin-right"></i>Name</button>
                <button class="w3-button w3-white w3-hide-small w3-text-blue-gray"><i class="fa fa-file w3-margin-right"></i>Description</button>
                <button class="w3-button w3-white w3-hide-smal w3-text-blue-gray"><i class="fa fa-file w3-margin-right"></i>Date</button>

                <span class="w3-margin-right w3-margin-left w3-text-blue-gray">Search:</span>

                <form id="theForm" class = "w3-input">
                    <input id="search" class = "w3-input" type="text" placeholder="Search..">
                </form>

                <button onclick="after_load_ajaxFunction('',true)" class="w3-margin-left w3-button w3-white"><i class="fa fa-folder w3-margin-right w3-text-blue-gray"></i>Clear Results</button>
                <button onclick="create_folder()" class="w3-margin-left w3-button w3-white"><i class="fa fa-folder w3-margin-right w3-text-blue-gray"></i>Add Folder</button>
            </div>
        </div>
    </header>

    <div id = "filepanel" class="w3-row-padding">
    </div>

    <!-- Upload Box -->
    <div class="image_upload_div" id="upload_box_div" id="upload_div">
        <form action="./upload.php" class="dropzone w3-margin-left w3-margin-right w3-text-grey" id="upload_box">
        </form>
    </div>

    <div class="w3-container w3-padding-large" style="margin-bottom:32px">
    </div>

    <div class="w3-center w3-grey w3-padding-24">Powered by MediaVault</div>
</div>
</body>

<script type="text/javascript" src="js/scripts.js"></script>
<script>

    var myvar = <?php echo json_encode($_SESSION['location']); ?>;
    open_folder(myvar);
</script>
<!--- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js">

</script>
<script src="./js/dropzone.js"></script>
<script type="text/javascript">
    //Disabling autoDiscover
    Dropzone.autoDiscover = false;
    $(function() {
        //Dropzone class
        var myDropzone = new Dropzone(".dropzone");
        myDropzone.on("queuecomplete", function() {
            location.reload();
        });
    });
</script>

<script>

    $("#theForm").submit(function(e) {
        e.preventDefault();
        search_files();
    });

</script>
</html>