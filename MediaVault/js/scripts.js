

// Script to open and close sidebar
function side_bar_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function side_bar_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

function log_out() {
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
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            location.reload();
        }
    }
    ajaxRequest.open("GET", "logout.php", true);
    ajaxRequest.send(null);
}

function sortBy(prop)
{
    return function(a,b)
    {
        if( a[prop] > b[prop])
        {
            return 1;
        }else if( a[prop] < b[prop] )
        {
            return -1;
        }
        return 0;
    }
}

function addDesc(file_id, desc){
    $.ajax({
            url: "metadata.php?fileId=" + file_id + "&desc=" + desc,
            success: function(response) {
                // do something
                    window.location.reload(false);
            }
    });
}


function load_files(response, sortByName, sortByMetaData, SortByDate){
    var output = document.getElementById('filepanel');
    var i=0;
    var val="";
    while (output.hasChildNodes()) {
        output.removeChild(output.lastChild);
    }

    try {
        var jsonObject = JSON.parse(response);
    }
    catch(e) {
        return;
    }



    while(i<=Object.keys(jsonObject).length)
    {
        if(!document.getElementById(jsonObject[i]["file_name"]+i))
        {
            var ele = document.createElement("div");
            ele.setAttribute("id",jsonObject[i]["file_name"]+i);
            ele.setAttribute("class","w3-third w3-container w3-margin-bottom w3-hover-opacity");

            var date = document.createElement("div");
            date.setAttribute("id",jsonObject[i]["creation_date"]+i);
            date.setAttribute("class","w3-third w3-container w3-margin-bottom w3-hover-opacity");
            date.setAttribute("hidden","true");

            var description = document.createElement("div");
            description.setAttribute("id",jsonObject[i]["details"]+i);
            description.setAttribute("class","w3-third w3-container w3-margin-bottom w3-hover-opacity");
            description.setAttribute("hidden","true");



            var imgEle = document.createElement("img");
            imgEle.setAttribute("src","Images/icons/" + jsonObject[i]["file_type"].toLowerCase() + ".png");
            imgEle.setAttribute("display","inline-block");
            imgEle.setAttribute("height","32");
            imgEle.setAttribute("width","32");
            imgEle.setAttribute("align","right");
            imgEle.setAttribute("vertical-align","middle");

            var childele = document.createElement("div");
            childele.setAttribute("id","childele"+i);
            childele.setAttribute("class","w3-container w3-white");
            childele.innerHTML= jsonObject[i]["file_name"] + "<br>" + "<br>" + "Description: " + jsonObject[i]["details"] + "<br><br>" ;
            childele.setAttribute("align","left");
            childele.setAttribute("float","left");
            childele.setAttribute("display","inline-block");
            childele.setAttribute("width","50%");


            if (jsonObject[i]["file_type"] == "folder"){
                var a = document.createElement('a');
                var linkText = document.createTextNode(" Open ");
                a.appendChild(linkText);
                a.title = "Open";
                var locationInside = jsonObject[i]["location_inside"].toString();

                a.onclick = (function(locationInside){
                        return function(){
                            open_folder(locationInside);
                            return false;
                        }
                    })(locationInside);

                var delete_button = document.createElement('a');
                var linkText = document.createTextNode(" Delete");
                var fileName = jsonObject[i]["file_name"];
                var file_id = jsonObject[i]["file_id"];
                delete_button.appendChild(linkText);
                delete_button.title = " Delete";
                delete_button.setAttribute("padding","0px 10px");
                delete_button .setAttribute("display","inline-block");
                delete_button.href = "#";
                delete_button.onclick = (function(fileName, file_id){
                    return function(){
                        delete_file(fileName, file_id);
                        return false;
                    }
                })(fileName,file_id);

                a.href = "#";
            }if (jsonObject[i]["file_type"] != "folder"){
                var a = document.createElement('a');
                var linkText = document.createTextNode(" Open | ");
                a.appendChild(linkText);
                a.title = " Open | ";
                a.href = "./mediavault_files/users/" + jsonObject[i]["file_location"] + "/" + jsonObject[i]["file_name"];
                a.target = "_blank";

                var download = document.createElement('a');
                var linkText = document.createTextNode(" Download | ");
                download.appendChild(linkText);
                download.title = " Download";
                download.href = "./mediavault_files/users/" + jsonObject[i]["file_location"] + "/" + jsonObject[i]["file_name"];
                download.download = jsonObject[i]["file_name"];

                var delete_button = document.createElement('a');
                var linkText = document.createTextNode(" Delete");
                var fileName = jsonObject[i]["file_name"];
                var file_id = jsonObject[i]["file_id"];
                delete_button.appendChild(linkText);
                delete_button.title = " Delete";
                delete_button.setAttribute("padding","0px 10px");
                delete_button .setAttribute("display","inline-block");
                delete_button.href = "#";
                delete_button.onclick = (function(fileName, file_id){
                    return function(){
                        delete_file(fileName, file_id);
                        return false;
                    }
                })(fileName,file_id);

                var edit = document.createElement('a');
                var linkText2 = document.createTextNode(" Edit Description |");
                var file_id2 = jsonObject[i]["file_id"];
                edit.appendChild(linkText2);
                edit.title = " | Edit Description | ";

                edit.onclick = (function(file_id2){
                    return function(){
                        var desc = window.prompt("Enter description:", "");
                        if(desc == null || desc == "") {
                            return false;
                        } else {
                            addDesc(file_id2, desc);
                            return false;
                        }
                    }
                })(file_id2);

                edit.href = "#";
                childele.appendChild(download);
                childele.appendChild(edit);
            }
            ele.appendChild(imgEle);
            ele.appendChild(childele);
            childele.appendChild(a);
            childele.appendChild(delete_button);
            output.appendChild(ele);
            output.appendChild(date);
            output.appendChild(description);
        }
        i++;
    }
}

//Search files
function open_folder(locationInside){
    var search_term = locationInside;
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
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            load_files(ajaxRequest.responseText);
            return false;
        }
    }

    ajaxRequest.open("GET", "open_folder.php?search_terms=" + search_term, true);
    ajaxRequest.send(null);

    var offsetHeight = document.getElementById('filepanel').offsetWidth;
    document.getElementById('upload_div').style.width = offsetHeight+'px';
    document.getElementById('upload_box').style.width = offsetHeight+'px';

    return false;
}

//Browser Support Code
function ajaxFunction(location, clearResults){
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
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            load_files(ajaxRequest.responseText, location);
            location.reload();
        }
    }

    if (clearResults == true){
        ajaxRequest.open("GET", "clear_search_results.php", true);
    }else{
        ajaxRequest.open("GET", "get_file_details.php?currentlocation=" + location, true);
    }
    ajaxRequest.send(null);

    var offsetHeight = document.getElementById('filepanel').offsetWidth;
    document.getElementById('upload_div').style.width = offsetHeight+'px';
    document.getElementById('upload_box').style.width = offsetHeight+'px';
}

function after_load_ajaxFunction(locationInside, clearResults){
    var results = clearResults;
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
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            load_files(ajaxRequest.responseText);

        }
    }

    if (results){
        ajaxRequest.open("GET", "clear_search_results.php", true);
    }else{
        ajaxRequest.open("GET", "get_file_details.php?locationInside=" + locationInside, true);
    }
    ajaxRequest.send(null);
}

//Search files
function search_files(){
    var search_term = document.getElementById('search').value;
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
    ajaxRequest.onreadystatechange = function(){
        if(ajaxRequest.readyState == 4){
            load_files(ajaxRequest.responseText);
            return false;
        }
    }

    ajaxRequest.open("GET", "search_files.php?search_terms=" + search_term, true);
    ajaxRequest.send(null);

    var offsetHeight = document.getElementById('filepanel').offsetWidth;
    document.getElementById('upload_div').style.width = offsetHeight+'px';
    document.getElementById('upload_box').style.width = offsetHeight+'px';

    return false;
}

//Onlick
function create_folder() {
    var folder = prompt("Name your folder:");
    if (folder == null || folder == "") {
        alert("Invalid file name")
    }else{
        $.ajax({
            url: "upload_folder.php?action=call_this&folderName=" + folder.toString(),
            success:function() {
                window.location.reload(false);
            }
        });
    }
}

function delete_file(file_name, file_id){
    var r = confirm("Are you sure you want to delete: " + file_name);
    if(r == true)
    {
        $.ajax({
            url: "delete.php?file=" + file_name + "&fileId=" + file_id,
            success: function(response) {
                // do something
                window.location.reload(false);
            }
        });
    }
}

$(document).ready(function() {
    var width = $(".filepanel").width();
    $(".upload_box").css({
        'width': (width + 'px')
    });
});

function update_email(){
    var email = prompt("Type new email address:");
    if (email == null || email == "") {
        alert("Invalid email address")
    }else{
        $.ajax({
            url: "update_email.php",
            type: "POST",
            dataType:'json',
            data:{action:'call_this', folderName: email.toString()},
            success:function() {
            }
        });
    }
}

function update_firstName(){
    var first = prompt("Type in your first name:");
    if (first == null || first == "") {
        alert("Invalid name")
    }else{
        $.ajax({
            url: "update_firstName.php",
            type: "POST",
            dataType:'json',
            data:{action:'call_this', folderName: first.toString()},
            success:function() {
            }
        });
    }
}

function update_lastName(){
    var last = prompt("Type in your last name:");
    if (last == null || last == "") {
        alert("Invalid name")
    }else{
        $.ajax({
            url: "update_lastName.php",
            type: "POST",
            dataType:'json',
            data:{action:'call_this', folderName: last.toString()},
            success:function() {
            }
        });
    }
}

function change_password(){
    var pass = prompt("Type in your new password:");
    if (pass == null || pass == "") {
        alert("Invalid password")
    }else{
        $.ajax({
            url: "change_password.php",
            type: "POST",
            dataType:'json',
            data:{action:'call_this', folderName: pass.toString()},
            success:function() {
            }
        });
    }
}

function sort_name(){
    var mylist = $('#filepanel');

    var listitems = mylist.children('div').get();

    listitems.sort(function(a, b) {
        return $(a).text().toUpperCase().localeCompare($(b).text().toUpperCase());
    });

    $.each(listitems, function(index, item) {
        mylist.append(item);
    });
}

function sort_description(){
    var mylist = $('#filepanel');
    var listitems = mylist.children("div");
    listitems.sort(function(a, b) {
        var compA = $(a).text().toUpperCase();
        var compB = $(b).text().toUpperCase();
        return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
    })
    $(mylist).append(listitems);
}
