function _(el){
    return document.getElementById(el);
}

function checkFileSize() {
    let filesize = _("myfile").files;
    var sum = 0;

    for (var i = 0; i <= filesize.length - 1; i++) {
        var fsize = filesize.item(i).size;
        sum += parseInt(fsize);

        
        var ftype = filesize.item(i).name.split('.').pop();
    }

    if(sum > 500 * 1024 * 1024) {
        let url = new URL(window.location.href);
        let urlValue = url.searchParams.get('foldername');

        window.location.replace('?foldername=' + rawURIComponent(urlValue) + '&tolarge');
    }

    
    var allowedExtensions = {
        "exe": true,
        "svg": true
    };

    if (allowedExtensions[ftype.toLowerCase()] == true) {
        let url = new URL(window.location.href);
        let urlValue = url.searchParams.get('foldername');

        window.location.replace('?foldername=' + encodeURIComponent(urlValue) + '&nosupport');
    }
}

function cancleErrorHandler() {
    let url = new URL(window.location.href);
    let urlValue = url.searchParams.get('foldername');

    window.location.replace('?foldername=' + encodeURIComponent(urlValue) + '&errnone');
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
    ajax.open("POST", "folders.php?foldername=<?php echo rawurlencode($_GET['foldername']); ?>");
    _("pleasewaitmsgonclick").innerHTML = "Please Wait...";
    _("show-progress-onUpload").style.display = "flex";
    ajax.send(formdata);
    //alert(file.name+" | "+file.size+" | "+file.type);
}

function progressHandler(event){
    var percent = (event.loaded / event.total) * 100;

    _("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
    _("status").innerHTML = Math.round(percent)+"% Uploaded...";
    _("progress-innerProgress").style.width = percent + "%";
}

function completeHandler(event){
    _("status").innerHTML = "Finalizing";
    _("progressBar").value = 0;
}

function errorHandler(event){
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event){
    _("status").innerHTML = "Upload Aborted";
}