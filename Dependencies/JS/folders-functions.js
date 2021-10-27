var maxbtn = _("window_max");
var closebtn = _("closebtn");
var iframe = _("iframe_full_screen_prev");
var unmax = _("window_unmax");
var control = _("win_max_controls");
//
var a = _("upload-222");
var i = _("btnrefresh");
var cc = _("tbody-info");
var cb = _("c123V2");
var uploadFormAn = _("form-to-upload-222");

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

function backtohome() {
    window.location.replace('upload.php');
}

function uploadshow() {
    var i = _("btnrefresh");
    var cb = _("c123V2");
    if (a.style.display === "none") {
        a.classList.add("form-show-animation");
        uploadFormAn.classList.add("form-show-zoom-animation")

        uploadFormAn.classList.remove("form-show-zoom-out-animation");
        a.classList.remove("form-show-none-animation");

        i.style.left = "120px";
        cb.style.display = "none";
        a.style.display = "flex";
        _("backbtn").style.display = "block";
        _("backtohomebtn").style.left = "225px";
    } else {
        uploadFormAn.classList.add("form-show-zoom-out-animation");
        a.classList.add("form-show-none-animation")

        setTimeout(function() {
            a.classList.add("form-show-animation") //
            uploadFormAn.classList.add("form-show-zoom-animation") //

            a.classList.remove("form-show-none-animation");
            uploadFormAn.classList.remove("form-show-zoom-out-animation");

            a.style.display = "none";
        }, 200)
        
        i.style.left = "160px";
        cb.style.display = "block";
        _("backbtn").style.display = "none";
        _("backtohomebtn").style.left = "265px";
    }
}

function refresh() {
    location.reload();
}

_("audio_prev_player").volume = 0.4;
_("audioPrevVolumeController").volume = 0.4;