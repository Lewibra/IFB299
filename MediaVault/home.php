<?php
    session_start();
    //require "dropbox-sdk/start.php";
    //require "dropbox-sdk/dropbox_auth.php";
    $_SESSION["username"] = "ltrac321";
?>
<!DOCTYPE HTML>
<html>
<head>
    <script type="text/javascript" src="scripts.js"></script>
</head>
<title>MediaVault</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="CSS/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <img src="Images/vault.png" style="width:20%;" class="w3-round"><br><br>
        <h4><b>MediaVault</b></h4>
        <p class="w3-text-grey">Lewis Tracy</p>
    </div>
    <div class="w3-bar-block">
        <a href="#myfiles" onclick="side_bar_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>MY FILES</a>
        <a href="#myprofile" onclick="side_bar_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>ABOUT</a>

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
            <h1><b>My Files</b></h1>
            <div class="w3-section w3-bottombar w3-padding-16">
                <span class="w3-margin-right">Filter:</span>
                <button class="w3-button w3-black">ALL</button>
                <button class="w3-button w3-white"><i class="fa fa-music w3-margin-right"></i>Music</button>
                <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
                <button class="w3-button w3-white w3-hide-small"><i class="fa fa-file w3-margin-right"></i>PDF</button>

                <span class="w3-margin-right w3-margin-left">Search:</span>
                <input class = "w3-input" type="text" name="search" placeholder="Search.." >

                <button onclick="create_folder()" class="w3-margin-left w3-button w3-white"><i class="fa fa-folder w3-margin-right"></i>Add Folder</button>
            </div>
        </div>
    </header>

    <div id = "filepanel" class="w3-row-padding">


    </div>


    <!-- Profile Details -->


    <div class="w3-container w3-padding-large" style="margin-bottom:32px">
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-32 w3-dark-grey">
        <div class="w3-row-padding">
            <div class="w3-third">
                <h3>FOOTER</h3>
                <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>

            </div>

            <div class="w3-third">
                <h3>PLACEHOLDER</h3>
                <ul class="w3-ul w3-hoverable">
                    <li class="w3-padding-16">
                        <img src="/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Lorem</span><br>
                        <span>Sed mattis nunc</span>
                    </li>
                    <li class="w3-padding-16">
                        <img src="/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
                        <span class="w3-large">Ipsum</span><br>
                        <span>Praes tinci sed</span>
                    </li>
                </ul>
            </div>

            <div class="w3-third">
                <h3>PLACEHOLDER</h3>
                <p>
                    <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
                    <span class="w3-tag w3-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
                    <span class="w3-tag w3-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
                    <span class="w3-tag w3-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
                    <span class="w3-tag w3-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
                </p>
            </div>

        </div>
    </footer>

    <div class="w3-black w3-center w3-padding-24">Powered by MediaVault</div>

    <!-- End page content -->
</div>

<script>
    window.onload = ajaxFunction();
</script>

<!--- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js">

</script>

</body>
</html>

