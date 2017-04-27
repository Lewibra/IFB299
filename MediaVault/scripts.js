// Script to open and close sidebar
function side_bar_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function side_bar_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
//Browser Support Code
function ajaxFunction($userName){
    var ajaxRequest;  // The variable that makes Ajax possible!

    try {
        // Opera 8.0+, Firefox, Safari
        ajaxRequest = new XMLHttpRequest();
    }catch (e) {
        // Internet Explorer Browsers
        try {
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }catch (e) {
            try{
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            }catch (e){
                // Something went wrong
                alert("Your browser broke!");
                return false;
            }
        }
    }

    // Create a function that will receive data
    // sent from the server and will update
    // div section in the same page.

    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            //var ajaxDisplay = document.getElementById('ajaxDiv');
            //ajaxDisplay.innerHTML = ajaxRequest.responseText;
            load_files(ajaxRequest.responseText);
        }
    }

    // Now get the value from user and pass it to
    // server script.

    ajaxRequest.open("GET", "get_file_details.php", true);
    ajaxRequest.send(null);
}
function load_files(response){

    var jsonObject = JSON.parse(response);

    var output = document.getElementById('filepanel');
    var i=0;
    var val="";
    while(i<=Object.keys(jsonObject).length)
    {

        if(!document.getElementById('timedrpact'+i))
        {
            var ele = document.createElement("div");
                ele.setAttribute("id","timedrpact"+i);
                ele.setAttribute("class","w3-third w3-container w3-margin-bottom w3-hover-opacity");


            var imgEle = document.createElement("img");
                imgEle.setAttribute("src","Images/icons/pdf.png");
                imgEle.setAttribute("display","inline-block");
                imgEle.setAttribute("height","32");
                imgEle.setAttribute("width","32");
                imgEle.setAttribute("align","right");
                imgEle.setAttribute("vertical-align","middle");

            var childele = document.createElement("div");
                childele.setAttribute("id","childele"+i);
                childele.setAttribute("class","w3-container w3-white");
                childele.innerHTML= jsonObject[i]["file_name"] + "<br>" + "<br>";
                childele.setAttribute("align","left");
                childele.setAttribute("float","left");
                childele.setAttribute("display","inline-block");
                childele.setAttribute("width","50%");


            ele.appendChild(imgEle);
            ele.appendChild(childele);

            output.appendChild(ele);

        }
        i++;
    }
}
//Onlick
function create_folder() {
    var folder = prompt("Name your folder:");
    if (folder == null || folder == "") {
        alert("Invalid file name")
    }else{
        $.ajax({
            url: "upload_folder.php",
            type: "POST",
            dataType:'json',
            data:{action:'call_this', folderName: folder.toString()},
            success:function() {
            }
        });
    }
}