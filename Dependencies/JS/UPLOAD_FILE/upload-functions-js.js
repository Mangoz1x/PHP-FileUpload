var a = _("upload-222");
var i = _("btnrefresh");
var cc = _("tbody-info");
var cb = _("c123V2");
var uploadFormAn = _("form-to-upload-222");

function uploadshow() {
    if (a.style.display === "none") {
        a.classList.add("form-show-animation");
        uploadFormAn.classList.add("form-show-zoom-animation")

        uploadFormAn.classList.remove("form-show-zoom-out-animation");
        a.classList.remove("form-show-none-animation")

        a.style.display = "flex";
        i.style.left = "120px";
        cb.style.display = "none";
        _("backbtn").style.display = "block";
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
    }
}

function refresh() {
    location.reload();
}
    
function areusuredelete() {
    var axva = _("areusuredeletemessage");

    axva.style.display = "block";
}

function deletefalse() {
    var axva = _("areusuredeletemessage");

    axva.style.display = "none";
}


var folderName = _("folder_name");
folderName.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        window.location.replace('?cfolder=' + encodeURIComponent(folderName.value));
    }
});

function createFolderManualSelect() {
    var folderName = _("folder_name");

    window.location.replace('?cfolder=' + encodeURIComponent(folderName.value));
}

//_("player").volume = 0.4;

function dropDownFolderOptions() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

function selectFolderName() {
    var createFolderArea = document.getElementById("inputFolderName");

    if (inputFolderName.style.display === "block") {
        inputFolderName.style.display = "none";
    } else {
        inputFolderName.style.display = "block";
    }
}

function selectFolderNameCancel() {
    var createFolderArea = document.getElementById("inputFolderName");

    createFolderArea.style.display = "none";
}

function sendToInbox() {
    var inbox = _("sendInboxContainer");
    var inboxBtn = _("sendInboxBtnOpen");
    var inboxContainer = _("wrapper-ContentSend");
    
    if (inbox.style.display === "none") {
        inboxBtn.style.display = "none";
        inbox.style.display = "flex";
        inboxBtn.innerHTML = "Back";
        inbox.classList.add("zoom-in-inbox") //
        inbox.classList.remove("zoom-out-inbox") //

        inboxContainer.classList.remove("fade-out-inbox");
        inboxContainer.classList.add("wrapper-ContentSend");

        inboxBtn.style.display = "block";
    } else {
        inboxContainer.classList.add("fade-out-inbox");
        inbox.classList.add("zoom-out-inbox") //
        inboxBtn.style.display = "none";

        setTimeout(function() {
            inbox.style.display = "none";
            inboxContainer.classList.add("wrapper-ContentSend");
            inboxContainer.classList.remove("fade-out-inbox");

            inbox.classList.add("zoom-in-inbox") //
            inbox.classList.remove("zoom-out-inbox") //
            inboxBtn.style.display = "block";
        }, 200)

        inboxBtn.innerHTML = "Inbox";
    }
}