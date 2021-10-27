function _(el){
    return document.getElementById(el);
}

function checkFileUpload() {
    let filesizeu = _("myfile").files;
    var sumu = 0;

    for (var i = 0; i <= filesizeu.length - 1; i++) {
        var fsizeu = filesizeu.item(i).size;
        sumu += parseInt(fsizeu);

        var ftypeu = filesizeu.item(i).name.split('.').pop();
    }

    if(sumu > 500 * 1024 * 1024) {
        let url = new URL(window.location.href);
        let urlValue = url.searchParams.get('foldername');

        window.location.replace('?foldername=' + encodeURIComponent(urlValue) + '&tolarge');
    }

    var allowedExtensionsU = {
        "exe": true,
        "svg": true
    };

    if (allowedExtensionsU[ftypeu.toLowerCase()] == true) {
        window.location.replace('?nosupport');
    }
}

function checkFileSizeUploadCustom() {
    let filesizec = _("myfileCustom").files;
    var sumc = 0;

    for (var i = 0; i <= filesizec.length - 1; i++) {
        var fsizec = filesizec.item(i).size;
        sumc += parseInt(fsizec);
    }

    if(sumc > 500 * 1024 * 1024) {
        window.location.replace('?tolarge');
    }
}

function cancleErrorHandler() {
    window.location.replace('?errnone');
}

function uploadFile() {
    var file = _("myfile").files[0];
    var formdata = new FormData();
    formdata.append("myfile", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.open("POST", "upload.php");
    _("disableIdOnclick").innerHTML = "Please Wait...";
    _("show-progress-onUpload").style.display = "flex";
    ajax.send(formdata);

    // alert(file.name+" | "+file.size+" | "+file.type);
}

function progressHandler(event){
    var percent = (event.loaded / event.total) * 100;

    _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
    _("status").innerHTML = Math.round(percent)+"% Uploaded...";
    _("progress-innerProgress").style.width = percent + "%";
    //_("progressBar").value = Math.round(percent);
}

function completeHandler(event){
    _("status").innerHTML = "Finalizing";
    _("progress-innerProgress").value = 0;
}

function errorHandler(event){
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event){
    _("status").innerHTML = "Upload Aborted";
}

//

function checkFileSizeUploadCustom() {
    let filesizec = _("myfileCustom").files;
    var sumc = 0;

    for (var i = 0; i <= filesizec.length - 1; i++) {
        var fsizec = filesizec.item(i).size;
        sumc += parseInt(fsizec);

        var ftypec = filesizec.item(i).name.split('.').pop();
    }

    if(sumc > 500 * 1024 * 1024) {
        window.location.replace('?tolarge');
    }

    var allowedExtensionsC = {
        "exe": true,
        "svg": true
    };

    if (allowedExtensionsC[ftypec.toLowerCase()] == true) {
        window.location.replace('?nosupport');
    }
}

function sendFileInbox() {
    var sendingUserName = _("sendingUidEmail");
    var file = _("myfileCustom").files[0];
    var formdata = new FormData();
    formdata.append("myfileCustom", file);
    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandlerInbox, false);
    ajax.addEventListener("load", completeHandlerInbox, false);
    ajax.addEventListener("error", errorHandlerInbox, false);
    ajax.addEventListener("abort", abortHandlerInbox, false);
    ajax.open("POST", "upload.php");
    _("show-progress-onUpload_Custom").style.display = "flex";
    ajax.send(formdata);

    //alert(file.name+" | "+file.size+" | "+file.type);
}

function progressHandlerInbox(event) {
    var percent = (event.loaded / event.total) * 100;

    _("loaded_n_total_Custom").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
    _("status_Custom").innerHTML = Math.round(percent)+"% Uploaded...";
    _("progress-innerProgress_Custom").style.width = percent + "%";
}

function completeHandlerInbox(event){
    _("status_Custom").innerHTML = "Finalizing";
    _("progress-innerProgress_Custom").value = 0;
}

function errorHandlerInbox(event){
    _("status_Custom").innerHTML = "Upload Failed";
}

function abortHandlerInbox(event){
    _("status_Custom").innerHTML = "Upload Aborted";
}