var maxbtn = document.getElementById("window_max");
var closebtn = document.getElementById("closebtn");
var iframe = document.getElementById("iframe_full_screen_prev");
var unmax = document.getElementById("window_unmax");
var control = document.getElementById("win_max_controls");

function windowmax() {
    maxbtn.style.right = "25px"; 
    maxbtn.style.display = "none";
    closebtn.style.display = "block";
    iframe.style.width = "100%";
    iframe.style.height = "93.6vh";
    unmax.style.right = "70px";
    unmax.style.display = "block";
    control.style.display = "block";
    iframe.style.bottom = "0px";
    iframe.style.zIndex = "0";
}

function windowunmax() {
    closebtn.style.display = "block";
    iframe.style.width = "85%";
    iframe.style.height = "75%";
    unmax.style.display = "none";
    maxbtn.style.right = "70px"; 
    control.style.display = "none";
    maxbtn.style.display = "block";
    iframe.style.bottom = "unset";
}

//document.getElementById("audio_prev_player").volume = 0.4;