function userDropDown() {
    let userDropDownOptions = document.getElementById("userOnclickHeaderDropDown");

    if (userDropDownOptions.style.display === "none") {
        userDropDownOptions.style.display = "block";
    } else {
        userDropDownOptions.style.display = "none";
    }
}

$(document).on("click","body",function(e) { 
    if(!$(e.target).hasClass("allDropDownPFPItems")) { 
      $(".mainDropDownPfpContent").hide(); 
    }
});