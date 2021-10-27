<style>
    body {
        height:100vh;
    }

    #player {
        width: 100px;
        outline: none;
    }​

    audio::-webkit-media-controls-play-button,
    audio::-webkit-media-controls-panel {
        background-color: #ccc;
        padding-right: 49px;
    }

    form {
        margin: auto;
        border: none;
        background-color:white;
        z-index: 99999;
    }

    .form-show-animation {
        animation: formshow 0.2s;
    }

    .form-show-none-animation {
        animation: formhide 0.2s;
    }
    
    .form-show-zoom-animation {
        animation: formzoomin 0.2s;
    }

    .form-show-zoom-out-animation {
        animation: formzoomout 0.2s;
    }

    @keyframes formhide {
        0% {
            /*transform: scale(0.6,0.6);*/
            opacity: 1;
        }
        100% {
            /*transform: scale(1,1);*/
            opacity: 0;
        }
    }

    @keyframes formzoomout {
        0% {
            transform: scale(1,1);
            opacity: 1;
        }
        100% {
            transform: scale(0.6,0.6);
            opacity: 0.0;
        }
    }

    @keyframes formshow {
        0% {
            /*transform: scale(0.6,0.6);*/
            opacity: 0.0;
        }
        100% {
            /*transform: scale(1,1);*/
            opacity: 1;
        }
    }

    @keyframes formzoomin {
        0% {
            transform: scale(0.6,0.6);
            opacity: 0.0;
        }
        100% {
            transform: scale(1,1);
            opacity: 1;
        }
    }

    .center-content-1av {
        margin-top:100px;
    }

    input {
        width:90%;
        border: 1px solid black;
        display:block;
        padding:5px 10px;
        border-radius: 40px;
    }

    .button1 {
        border: none;
        padding:15px 20px;
        border-radius: 40px;
        float:left;
        margin-left:5%;
        color: white;
        background-color: #4542ff;
    }

    input::-webkit-file-upload-button {
        color: white;
        display: inline-block;
        background-color: #4542ff;
        border: none;
        padding: 12px 17px;
        font-weight: 700;
        border-radius: 3px;
        white-space: nowrap;
        cursor: pointer;
        font-size: 10pt;
        outline:none;
        border-radius: 40px;
    }

    .button-show {
        position:fixed;
        bottom:30px;
        left:30px;
        padding:15px 20px;
        border-radius: 40px;
        background-color:#4542ff;
        border:none;
        outline:none;
        color: white;
    }

    .button-hide {
        position:fixed;
        bottom:30px;
        left:30px;
        padding:15px 20px;
        border-radius: 40px;
        background-color:#4542ff;
        border:none;
        z-index: 9999999;
        outline:none;
        color: white;
    }

    .download-btn {
        text-decoration: none;
        color: black;
        font-size: 20px;
    }

    .button-refresh {
        position:fixed;
        bottom:30px;
        padding:15px 20px;
        border-radius: 40px;
        background-color:#4542ff;
        border:none;
        z-index: 9999999;
        outline:none;
        position:fixed;
        bottom:30px;
        left:160px;
        color: white;
    }
    
    .goto-btn {
        margin-left:6px;
        color: blue;
        text-decoration: none;
        color: black;
        font-size: 20px;
    }

    button:hover {
        background-color:#5957ff;
        transition: 0.4s;
    }

    button {
        transition:0.4s;
    }

    .folder-container {
        height: fit-content;
        border: 1px solid black;
        border-left: none;
        border-right: none;
        /* background-color: #333333;
        box-shadow: 0px 0px 13px -2px #000000; */
        width: 97%;
        margin-top: 40px;
        margin-bottom: 100px;
    }

    .foldersItemTag {
        padding-top: 40px;
        margin-left: 1.5%;
    }

    .center_content_x {
        display: flex;
        justify-content: center;
        width: 100%;
    }

    .folder_btns {
        text-decoration: none;
        color: black;
        display: inline-block;
        margin: 10px;
        color: black;
    }

    .folder_container_div {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: flex-start;
        flex-direction: column;
    }

    .btn_folder_container_folders {
        border: 1px solid black;
        display: inline-block;
        padding: 5px 20px !important;
        margin-top: -1px;
        border-left: none;
        border-right: none;
        border-bottom: none;
    }

    .btn_delete_forfolders {
        float: right;
        margin: 8px;
    }

    .show_max_folder_content_prevSizeImg {
        max-height: 100% !important;
        max-width: 100% !important;
        max-height: 100%;
        max-width: 100%;
    }

    .wrapDivContent_FullWrap {
        color: black;
        margin-left: 25px;
        margin-right: 25px;
        margin-top: 50px;
        max-width: 470px;
        width: 400px;
        min-width: 400px;
        box-shadow: 0px 0px 13px 0px rgba(0,0,0,0.8);
    }

    .folder_container_view_url {
        /*border: 1px solid black;*/
        max-width: 550px;
        display: flex;
        align-items: flex-end;
        flex-direction: row;
        margin-top: -1px;
    }

    .show_max_folder_content_prevSize {
        outline: none;
        max-width: 550px;
        width: 100%;
        height: 100%;
        background-color: #303030;
    }

    .center_content_xCustomFolderPreview {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: center;
        padding-bottom: 200px;
    }

    .SongFolderMaxContentPreview {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        background-color: #303030;
    }

    .SongFolderMaxContentPreview h2 {
        color: white;
        text-align: center;
        max-width: 85%;
    }

    .href_asda2 {
        color: black !important; 
        width: 100%;
        padding: 27px;
        margin-right: 80px;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
    }

    .show_folder_item_preview {
        height: 200px;
        position: relative;
        /*border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;*/
    }

    .float_btns_right {
        float: right;
        text-align: right;
        margin-right: 20px;
        padding-bottom: 27px;
    }

    .file-size {
        padding-right: 50px !important;
    }

    .actions_TDClass {
        padding-right: 50px !important;
    }

    /*.file_queu_div {
        position: fixed;
        bottom: 40px;
        right: 40px;
        height: 270px;
        width: 240px;
        z-index: 9999999;
        box-shadow: 0px 0px 15px -2px rgba(0, 0, 0, 0.5);
        background-color: rgba(0, 0, 0, 0.1);
        word-wrap:break-word;
        padding: 30px;
    }*/
    
    .uploading-status {
        position: fixed;
        top:0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
        z-index: 9999999999999999;
        background-color: white;
        color: #303030;
    }

    .center_content_x_z_y {
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
    }

    .osuLogoPng {
        max-width: 40%;
        max-height: 80%;
    }

    .show_max_folder_content_prevSizePdf {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 60px;
        bottom: 0;
    }

    .show_max_folder_content_prevSizePdf_thumb {
        width: 100%;
        height: 100%;
    }

    .fileContentsPlain-Text {
        width: 100%;
        height: 100%;
        border-radius: 0;
        position: fixed;
        top: 60px;
        bottom: 0;
        border: none;
        border-bottom: 1px solid black;
        outline: none;
    }

    .fileContentsPlain-Text_thumb {
        width: 100%;
        height: 100%;
        border-radius: 0;
        border: none;
        border-bottom: 1px solid black;
        outline: none;
    }

    #progressBar_Custom {
        height: 20px;
        width: 300px;
        border-radius: 0;
        background-color: #4542ff;
    }
    
    .folderMobileOrganizer {
        width: fit-content;
        float: right;
    }

    .divBorderMobileStyler {
        display: none;
    }

    .resonsiveMargin12px {
        margin-bottom: 12px;
    }

    @media only screen and (max-width: 1500px) {
        table {
            width: 90%;
        }

	    .file_name_table {
            text-overflow: ellipsis;
            overflow: hidden; 
            max-width: 120px; 
            white-space: nowrap;
        }

        .folder-container {
            width: 97%;
        }
    }

    @media only screen and (max-width: 1250px) {
        .folder-container {
            width: 97%;
        }
    }

    @media only screen and (max-width: 1050px) {
        #file-prev-div {
            display: none;
        }

        #prv-th {
            display: none;
        }

        .actions_TDClass {
            padding: 0 !important;
        }
    }

    @media only screen and (max-width: 900px) {
        .folderMobileOrganizer {
            width: fit-content;
            float: unset;
            padding-top: 5px;
        } 

        .folder_btns {
            font-size: 14px;
            word-break: break-all;
            padding-bottom: 5px;
        }

        .divBorderMobileStyler {
            width: 100%; 
            border-bottom: 1px solid #4542ff;
            display: block;
        }
    }

    @media only screen and (max-width: 700px) {
        .responsiveDisplayNone {
            display: none !important;
        }

        .centerY {
            max-width: 47%;
        }
    }

    @media only screen and (max-width: 650px) {
        .file-size {
            display: none;
        }
    }

    @media only screen and (max-width: 580px) {
        .responsiveBorder {
            border-left: 1px solid black;
            padding-left: 10px;
        }

        .displayNoneResponsiveUplBtn {
            display: none;
        }
    }

    @media only screen and (max-width: 615px) {
        .wrapDivContent_FullWrap {
            max-width: 400px;
            width: 300px;
            min-width: 300px;
        }

        .resonsiveMargin12px {
            margin-bottom: 0;
        }

        .centerY {
            max-width: 47%;
            flex-direction: column;
        }

        .href_asda2 {
             margin-right: 20px;
        }
    }

    .formvalidatebtn {
        background-color: transparent !important;
        border-radius: 0;
        width: fit-content;
        color: #ddd;
        outline: none;
        z-index:0;
    }

    .formValidatePublicSharing {
        display: flex;
        justify-content: center;
        z-index:0;
    }

    .selectFormOption {
        background-color: transparent !important;
        border-right: 1px solid #4542ff;
        padding-right: 10px;
        border-top: none;
        border-bottom: none;
        border-left: none;
        outline: none;
        color: black;
        z-index:0;
    }

    .resetCssNew {
        position: unset;
        display: unset;
    }

    .center_content_form_x {
        display: flex;
        justify-content: center;
        width: fit-content;
        margin-top: 8px !important;
        padding: 0 !important;
        float: right;
    }

    .wordBreak {
        word-break: break-word;
    }

    #inboxContainer {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 1);
        z-index: 999999999999999;
    }

    .customUplBtnInbox {
        position: fixed;
        bottom: 30px;
        left: 30px;
        border-radius: 40px;
        border: none;
        padding: 15px 43px !important;
    }

    .inboxTitle {
        margin-top: 20px;
        width: 95.5%;
        border-bottom: 1px solid black;
    }

    .inboxIncomingRequest {
        height: 100px;
        width: 100%;
        border-top: 1px solid black;
        margin-top: -1px;
    }

    .centerContentY {
        display: flex;
        height: 100%;
        align-items: center;
        width: fit-content;
    }

    .float_right {
        float: right;
    }

    .float_left {
        float: left;
    }

    .acceptInboxRequest {
        padding: 15px 20px;
        border: none;
        background-color: #4542ff;
        color: white;
    }

    #inboxAcceptBanner {
        width: 50%;
        height: 25px;
        background-color: rgba(0, 217, 0, 0.5);

        position: fixed;
        left: 50%;
        top: 25px;
        transform: translateX(-50%);
    }

    #sendInboxContainer {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper-ContentSend {
        width: 60%;
        height: 50%;
        margin: 0;
        padding: 0;
        background-color: white;
        border-radius: 10px;
        animation: zoominoutsinglefeatured 0.2s;
    }

    .fade-out-inbox {
        width: 60%;
        height: 50%;
        margin: 0;
        padding: 0;
        background-color: white;
        border-radius: 10px;
        animation: zoomout 0.2s;
    }

    @keyframes zoominoutsinglefeatured {
        0% {
            transform: scale(0.6,0.6);
            opacity: 0.6;
        }
        100% {
            transform: scale(1,1);
            opacity: 1;
        }
    }

    @keyframes zoomout {
        0% {
            transform: scale(1,1);
            opacity: 1;
        }
        100% {
            transform: scale(0.6,0.6);
            opacity: 0.0;
        }
    }

    #sendingUidEmail {
        width: 90%;
        padding-top: 10px !important;
        padding-bottom: 10px !important;
        outline: none;
        border-radius: 10px !important;
        background-color: #e0e0e0;
        border: none;
    }

    .select-file_Send {
        border-radius: 10px !important; 
        background-color: #cccccc;
        border: none;
    }

    .customForm {
        width: 100% !important;
    }

    .customFormDiv {
        width: 89%;
    }

    .centerContentX_Custom_form_request {
        display: flex;
        width: 100%;
        justify-content: center;
        flex-direction: unset;
    }

    .createFolderManualContainer {
        float: left;
        margin-left: 5%;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .changeMarginSend {
        margin: 0 !important;
        border-radius: 10px;
    }

    .asghi2Responsive {
        padding-top: 5px !important;
    }

    .sentMail {
        width: 95%;

    }

    .addSentMailBorder {
        width: 100%;
        border-bottom: 1px solid black;
    }

    .overflowScroll {
        overflow: auto;
        max-height: 200px;
    }

    .overflowScroll_width {
        overflow: auto;
        max-height: 300px;
    }

    .overflowScroll_width1 {
        overflow: auto;
        max-height: 100vh;
    }

    .displayBlock {
        display: inline-block;
    }

    .circle-progress {
        width: 90%;
        height: 30px;
        background-color: #404040;
    }

    .progress-innerProgress {
        height: 100%;
        max-width: 100%;
        background-color: black;
    }

    .upload-222 {
        width: 60%;
        height: 50%;
        position: unset !important;
        border-radius: 10px;
    }

    .dark-bg {
        background-color: rgba(0,0,0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
    }

    .dark-bg-custom {
        background-color: rgba(0,0,0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 99999;
    }

    #hide-upload-progress {
        width: 60% !important;
        height: 50%;
        background-color: whitesmoke;
        border-radius: 10px;
    }
    
    .width-max-content {
        width: 90%;
    }

    .add-margin-custom-create {
        margin-top: 30px;
    }

    .margin-ntsh {
        margin-left: 1.4%;
    }

    .max-width-75 {
        max-width: 75%;
    }

    .font-responsive strong {
        color: #6b69ff;
        border-bottom: 2px solid black;
    }

    .font-responsive-folders strong {
        color: #6b69ff;
        border-bottom: 2px solid black;
    }

    .max-height-pdf-view {
        max-height: 93vh;
        max-width: 100%;
    }

    @media only screen and (max-height: 850px) {
        .middleClassSelector_FolderName {
            height: 65% !important;
        }

        .wrapper-ContentSend {
            height: 65% !important;
        }

        .upload-222 {
            height: 65% !important;
        }

        #hide-upload-progress {
            width: 65% !important;
        }
    }

    @media only screen and (max-height: 600px) {
        .middleClassSelector_FolderName {
            height: 70% !important;
        }

        .wrapper-ContentSend {
            height: 70% !important;
        }

        #hide-upload-progress {
            width: 70% !important;
        }
    }

    @media only screen and (max-width: 1250px) {
        .wrapper-ContentSend {
            width: 95%;
            height: 50%;
            margin: 0;
            padding: 0;
            background-color: white;
            border-radius: 10px;
        }

        .upload-222 {
            width: 95% !important;
        }

        #hide-upload-progress {
            width: 95% !important;
        }
    }

    @media only screen and (max-width: 420px) {
        .add-margin-custom-create-input {
            margin-top: 50px;
        }
    }

    .custom-file-upload-myfile {
        border: none;
        border-radius: 10px !important;
        background-color: #cccccc !important;
    }

    .upload-confirm-button-styling {
        border-radius: 10px !important;
    }

    .responsive-text-container {
        width: 100%;
        word-break: break-all;
    }

    .responsive-text-container h1 {
        margin: 40px;
    }

    @media only screen and (max-width: 800px) {
        .responsive-text-container h1 {
            font-size: 20px !important;
        }

        .font-responsive {
            font-size: 21px !important;
        }

        .font-responsive-folders {
            font-size: 14px;
        }
    }
</style>