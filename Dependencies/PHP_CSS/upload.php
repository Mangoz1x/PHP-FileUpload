<style>
    .iframe_full_screen_prev {
        position: absolute;
        width: 85%;
        height: 75%;
        border: 1px solid black;
        background-color:white;
        padding: 0px;
    }

    .win_max_controls {
        height:60px;
        width:100%;
        background-color: transparent;
        z-index: 9999;
        position:absolute;
        top:0;
    }

    .href_close_screen_prev {
        font-size: 28px;
        color: rgba(199, 188, 199, 0.933);
        text-decoration: none;
        font-family:Arial, Helvetica, sans-serif;
        z-index: 999999999;
        position: fixed;
        right: 20px;
    }

    .full-frame {
        height: 100%;
        width: 100%;
        position:fixed;
        bottom: 0;
        left: 0;
        z-index: 99999999;
        background-color: #212121;
    }

    .file_name {
        color:lightgrey;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin-left: 20px;
        padding: 0;
        margin: 0;
        text-overflow: ellipsis;
        overflow: hidden; 
        width: 50%; 
        height: 1.2em; 
        white-space: nowrap;
        float: left;
        position: fixed;
        left: 20px;
    }

    .fullFileContainer p {
        margin: 0;
    }

    .uplBtn p {
        margin: 0;
    }

    .FriendlyUiInteract {
        color: #0081de;
        font-size: 82px;
        margin: 0;
        margin-top: 40px;
    }

    .centerContent {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        flex-direction: column;
    }

    .bottomContent {
        display: flex;
        align-items: flex-end;
        width: 100%;
        height: 100%;
    }

    .backgroundFile {
        background-color:#dedede;
        height: 100%;
        width: 100%;
        /*border-radius: 41px;*/
    }

    .backgroundFile .topSpacer {
        width: 100%;
        height: 10%;
        min-height: 80px;
        border-radius: 40px;
    }

    .backgroundFile .fullFileContainer {
        width: 100%;
        height: 90%;
        background-color: white;
        /*border-radius: 40px;*/
    }

    .topSpacerContentUploaded {
        height: 100%;
        display: flex;
        align-items: center;
        margin-left: 40px;
        width: fit-content;
        float: left;
        padding-right: 40px;
        border-right: 1px solid black;
    }

    .TotalUploadedSize {
        float: left;
        height: 100%;
        display: flex;
        align-items: center;
        padding-left: 40px;
    }

    .floatRight {
        float: right;
        margin-right: 40px;
    }

    .floatLeft {
        float: left;
        margin-left: 1.4%;
    }

    .uplBtn {
        padding: 10px 20px;
        background-color: #4542ff;
        color: white;
    }

    .uplBtnContainer {
        display: flex;
        align-items: center;
        height: 100%;
    }

    .file {
        width: 97%;
        height: fit-content;
        min-height: 50px;
        border-bottom: 1px solid black;
        border-top: 1px solid black;
        margin-bottom: -1px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .centerContentX {
        display: flex;
        width: 100%;
        justify-content: center;
    }

    .centerY {
        display: flex;
        height: 100%;
        width: fit-content;
        align-items: center;
    }

    .centerY:nth-child(2) p {
        border-left: 1px solid black;
        padding-left: 40px;
    }

    .displayFlex {
        display: flex;
        align-items: center;
        height: 100%;
    }

    .dropbtn {
        background-color: #3498DB;
        color: white;
        padding: 16px 62px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .dropbtn:hover, .dropbtn:focus {
        background-color: #2980B9;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 200px;
        overflow: auto;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        margin-top: -5px;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}

    #inputFolderName {
        z-index: 99999999999;
        background-color: rgba(0,0,0,0.7);
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0;
        top: 0;
        overflow: hidden;
        display: none;
    }

    .middleClassSelector_FolderName {
        width: 60%;
        height: 50%;
        background-color: whitesmoke; 
        border-radius: 10px;
    }

    #folder_name {
        width: 80%;
        border-radius: 0;
        margin-top: -140px;
        outline: none;
        color: black;
        padding: 10px 30px !important;
        box-shadow: 0px 0px 10px -2px rgba(0, 0, 0, 0.8);
        border-radius: 10px;
        background-color: #dedede;
        border: none;
        margin-bottom: 10px !important;
    } 

    .cancleboxBtn {
        margin-left: 15px;
    }

    .createFolderManual {
        font-size: 19px;
        color: white;
        padding: 15px 30px;
        background-color: #4542ff;
        border-radius: 10px;
    }

    .deleteFolderManual {
        font-size: 19px;
        color: white;
        padding: 15px 30px;
        background-color: #4542ff;
    }

    .createFolderManualContainer {
        width: 85%;
        margin-top: 20px;
    }

    .contentDeleteFolderMsg {
        height: 100px;
    }

    .display-flex-responsive-false {
        display: unset !important;
    }

    .marginSpacer {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 5px;
    }

    .marginSpacerCustomMax {
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 5px;
    }

    .deleteConfirmBackground {
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        z-index: 99999999999999999999;
        position: fixed;
        top: 0;
        left: 0;
    }

    .confirmDeleteMain {
        height: 50%;
        width: 50%;
        background-color: #e3e3e3;
        border-radius: 10px;
    }

    .align-items-left {
        width: 100%;
        height: 100%;
        float: left;
    }

    .max-width {
        max-height: 85%;
        max-width: 100%;
        position: fixed;
    }

    .AlignItemsToCenter {
        max-width: 100%;
        width: 100%;
        position: fixed;
        top: 60px;
        bottom: 0;
        display: flex;
        align-items: center;
    }

    .top-file-info-container {
        height: 60px;
        width: 100%;
        display: flex;
        align-items: center;
        position: fixed;
        top: 0;
        background-color: black;
    }

    .limit-width-justify {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        position: relative;
    }

    .file_html_show_contents {
        width: 100%;
        position: fixed;
        top: 60px;
        bottom: 0;
        border: none;
        outline: none;
    }

    .max-content {
        max-width: 90%;
    }

    .zoom-in-inbox {
        animation: zoominbg 0.2s; 
    }

    @keyframes zoominbg {
        0% {
            background-color: rgba(0,0,0, 0.1);
        }
        100% {
            background-color: rgba(0,0,0, 0.7);
        }
    }

    .zoom-out-inbox {
        animation: zoomoutbg 0.2s; 
    }

    @keyframes zoomoutbg {
        0% {
            background-color: rgba(0,0,0, 0.7);
        }
        100% {
            background-color: rgba(0,0,0, 0.1);
        }
    }

    @media only screen and (max-width: 750px) {
        #hide-upload-progress {
            width: 95% !important;
        }
    }
</style>