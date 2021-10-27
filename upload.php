<?php
    error_reporting(0);
    include_once "header.php";
    include_once "includes/dbh.inc.php";
    include_once "Dependencies/PHP_CSS/classroom.php";
    include_once "Dependencies/PHP_CSS/upload.php";
    include_once "includes/Logging/log-uploads.php";
    include_once "Dependencies/Error/handler.php";

    if (isset($_SESSION["useruid"])) {
        include_once "class/upload.php";
        include_once "Dependencies/PHP/Functions/UPLOAD_FILES/setFolderShareSubmit.php";
        include_once "Dependencies/PHP/Functions/UPLOAD_FILES/setShareSubmit.php";
        
        $useruid = $_SESSION["useruid"];
        ?>   
        <head> 
            <link rel="stylesheet" type="text/css" href="Dependencies/CSS/loader.css">
            <link rel="stylesheet" href="Dependencies/CSS/upload-responsive.css">
            <link rel="stylesheet" href="Dependencies/CSS/UPLOAD_FILES/upload.css">
            <script src="./Dependencies/JS/upload-logic.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        </head>
        <body class="body">
            <div class="container" id="hideonclickupload">
                <div class="centerContent">
                    <div class="backgroundFile">
                        <div class="topSpacer">
                            <div class="floatLeft">
                                <div class="uplBtnContainer"> 
                                    <?php
                                        include_once "Dependencies/PHP/Functions/UPLOAD_FILES/databaseStartQuery.php"; 
                                    ?> 
                                    <button class="uplBtn displayNoneResponsiveUplBtn" onclick="uploadshow()" style="border: none; padding: 12px 20px;">
                                        <p>Upload <i class="fas fa-file-import" style="margin-left: 5px;"></i></p>
                                    </button>
                                    <button class="uplBtn" onclick="inbox()" id="inboxBtnOpen" style="margin-left: 25px; border: none; padding: 12px 20px;">
                                        <p>Inbox (<?php echo $inboxCount; ?>)</p>
                                    </button>
                                    <button class="uplBtn" onclick="sendToInbox()" id="inboxBtnOpen" style="margin-left: 25px; border: none; padding: 12px 20px;">
                                        <p>Send</p>
                                    </button>
                                    <script> 
                                        function inbox() {
                                            var inbox = _("inboxContainer");
                                            var inboxBtn = _("inboxBtnOpen");
                                            
                                            if (inbox.style.display === "none") {
                                                inbox.style.display = "block";
                                                inboxBtn.innerHTML = "Back";
                                            } else {
                                                inbox.style.display = "none";
                                                inboxBtn.innerHTML = "Inbox <?php echo "(" . $inboxCount . ")"; ?>";
                                            }
                                        }
                                    </script> 
                                </div>
                            </div>
                            <?php 
                                $sql = "SELECT * FROM class_files WHERE usersid=?";
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    ?>
                                        <script>
                                            window.location.replace('?err');
                                        </script>
                                    <?php 
                                } else {
                                    mysqli_stmt_bind_param($stmt, "s", $useruid);
                                    mysqli_stmt_execute($stmt);
                                }

                                $result = mysqli_stmt_get_result($stmt);
                                $fileCount = mysqli_num_rows($result);
                            ?>
                            <div class="floatRight">
                                <div class="topSpacerContentUploaded">
                                    <p>Uploaded: <?php echo $fileCount;?></p>
                                </div>
                                <div class="TotalUploadedSize">
                                    <p>
                                        <?php 
                                            $sql = "SELECT SUM(size) AS totalSize FROM class_files WHERE usersid=?";
                                            $stmt = mysqli_stmt_init($conn);

                                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                                ?>
                                                    <script>
                                                        window.location.replace('?err');
                                                    </script>
                                                <?php 
                                            } else {
                                                mysqli_stmt_bind_param($stmt, "s", $useruid);
                                                mysqli_stmt_execute($stmt);
                                            }

                                            $result = mysqli_stmt_get_result($stmt);

                                            while($row = $result->fetch_assoc()) {
                                                echo round($row['totalSize'] / 1000000) . 'mb'; 
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="fullFileContainer">
                            <div class="foldersItemTag">
                                <p>Folders</p>
                            </div>
                            <div class="center_content_x">
                                <div class="folder-container">
                                    <div>
                                        <!--<input type="text" placeholder="folder name" id="folder_name" value="" style="margin-bottom: 10px;" maxlength="55"/>-->
                                        <div class="dropdown">
                                            <button onclick="dropDownFolderOptions()" class="dropbtn">Add</button>
                                            <div id="myDropdown" class="dropdown-content">
                                                <a onclick="selectFolderName()">Folder</a>
                                                <!--<a href="#spacer">Spacer</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $sql = "SELECT * FROM folders WHERE usersUid=?"; 
                                        $stmt = mysqli_stmt_init($conn);

                                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                                            ?>
                                                <script>
                                                    window.location.replace('?err');
                                                </script>
                                            <?php 
                                        } else {
                                            mysqli_stmt_bind_param($stmt, "s", $useruid);
                                            mysqli_stmt_execute($stmt);
                                        }

                                        $result = mysqli_stmt_get_result($stmt);
                                        foreach ($result as $row) {
                                            echo '<div class="folder_container_div">';
                                                echo '<div class="btn_folder_container_folders">';
                                                    echo '<a class="folder_btns" href="folders.php?foldername=' . htmlentities(rawurlencode($row["folderName"])) . '"><i class="fa fa-folder" aria-hidden="true" style="margin-right: 10px;"></i>' . htmlentities($row['folderName']) . '</a>';
                                                    ?>
                                                    <div class="divBorderMobileStyler"></div>
                                                        <div class="folderMobileOrganizer">
                                                            <a onclick="<?php echo "a" . $row['id']; ?>confirmDelete()" style="text-decoration: none;" class="btn_delete_forfolders">
                                                                <i class="fa fa-trash" aria-hidden="true" style="font-size:20px; margin-left:2px; color:#6b69ff;"></i>
                                                            </a>
                                                            <a href="folderPublicView.php?foldername=<?php echo rawurlencode($row['folderName']); ?>&folderPublicUid=<?php echo $row['usersUid']; ?>" class="btn_delete_forfolders">
                                                                <i class="fas fa-share" aria-hidden="true" style="font-size:20px; margin-left:10px; color: #6b69ff;" title="preview link"></i>
                                                            </a>
                                                            <form action="?folderValueName=<?php echo rawurlencode($row['folderName']); ?>" method="POST" class="resetCss formValidatePublicSharing resetCssNew" name='form_name'>
                                                                <div class="center_content_form_x">
                                                                    <select name="setFolderShare" class="selectFormOption" onchange='document.getElementById("formSubmitFolderStatus<?php echo rawurlencode($row["folderName"]); ?>").click();' style="min-width: 150px;">
                                                                        <option value="<?php echo rawurlencode($row['publicView']); ?>" style="color: black;">Status: <?php echo $row['publicView']; ?></option>
                                                                        <option value="public" style="color: black;">Public</option>
                                                                        <option value="private" style="color: black;">Private</option>
                                                                    </select>
                                                                    <input style="display: none;" type="submit" value="submit" name="setFolderShareSubmit" id="formSubmitFolderStatus<?php echo rawurlencode($row['folderName']); ?>" class="resetCss formvalidatebtn">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <script> 
                                                            function <?php echo "a" . $row['id']; ?>confirmDelete() {
                                                                var confirmDeleteShow = document.getElementById("deleteConfirmBackground<?php echo $row['id']; ?>");
                                                                
                                                                if (confirmDeleteShow.style.display === "none") {
                                                                    confirmDeleteShow.style.display = "block";
                                                                } else {
                                                                    confirmDeleteShow.style.display = "none";
                                                                }
                                                            }
                                                        </script>
                                                        <div class="deleteConfirmBackground" id="deleteConfirmBackground<?php echo $row['id']; ?>" style="display: none;">
                                                            <div class="centerContent">
                                                                <div class="confirmDeleteMain">
                                                                    <div class="centerContent">
                                                                        <div class="contentDeleteFolderMsg">
                                                                            <div class="center_content_x">
                                                                                <p class="applyParaMaxWidth" style="text-align:center;">Are you sure you want to delete the folder <strong>"<?php echo htmlentities($row['folderName']); ?>"</strong>?<br>
                                                                                once deleted, this folder will be deleted forever.</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="folderDelteManual">
                                                                            <div class="center_content_x display-flex-responsive-false">
                                                                                    <a href='?folderdelete=<?php echo $row['id'];?>&folderdeletename=<?php echo rawurlencode($row['folderName']); ?>' class="deleteFolderManual btnDelteFolder1" style="text-decoration: none;">Delete</a>
                                                                            </div>
                                                                            <div class="center_content_x display-flex-responsive-false">
                                                                                <a onclick="<?php echo "a" . $row['id']; ?>confirmDelete()" class="cancleboxBtn deleteFolderManual btnDelteFolder2">Cancel</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    <?php
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                        if (mysqli_num_rows($result) == 0) {
                                            echo '<div class=" max-width-75">';
                                                echo '<h4 class="font-responsive-folders">Looks like you dont have any <strong onclick="selectFolderName()">folders</strong>!</h4>';
                                            echo '</div>'; 
                                        }
                                    ?>
                                    <div id="inputFolderName">
                                        <div class="centerContent">
                                            <div class="middleClassSelector_FolderName">
                                                <div class="centerContent">
                                                    <div class="add-margin-custom-create-input"></div>
                                                    <input type="text" placeholder="folder name" id="folder_name" value="" style="margin-bottom: 10px;" maxlength="55"/>
                                                    <div class="createFolderManualContainer">
                                                        <div class="add-margin-custom-create"></div>
                                                        <a onclick="createFolderManualSelect()" class="createFolderManual">Create</a>
                                                        <a onclick="selectFolderNameCancel()" class="cancleboxBtn createFolderManual">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: fit-content; padding-bottom: 120px;">
                                <div class="centerContentX" style="margin-bottom: 30px;">
                                    <div class="file" style="border: none; margin-top: 20px;">
                                        <div class="centerY" style="width: 50%;">
                                            <p style="width: 100%;">Name</p>
                                        </div>
                                        <div class="centerY responsiveDisplayNone" style="width: fit-content;">
                                            <p style="width: 100%; border: none; color: transparent; margin-left: 1px;">Date</p>
                                        </div>
                                        <div class="centerY dateTimeResponsive responsiveDisplayNone" style="width: fit-content; padding-right: 287px;">
                                            <p style="width: 100%;">Edited</p>
                                        </div>
                                        <div class="centerY">
                                            <p style="width: 100%; text-align: right;">Actions</p>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    $sql = "SELECT * FROM class_files WHERE usersid=?"; 
                                    $stmt = mysqli_stmt_init($conn);

                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        ?>
                                            <script>
                                                window.location.replace('?err');
                                            </script>
                                        <?php 
                                    } else {
                                        mysqli_stmt_bind_param($stmt, "s", $useruid);
                                        mysqli_stmt_execute($stmt);
                                    }

                                    $result = mysqli_stmt_get_result($stmt);

                                    if (mysqli_num_rows($result) == 0) {
                                        echo '<div class="margin-ntsh max-width-75">';
                                            echo '<h2 class="font-responsive">Looks like you dont have any <strong onclick="uploadshow()">files uploaded</strong>!</h2>';
                                        echo '</div>'; 
                                    }

                                    foreach ($result as $row) {
                                        $newFileNameAfterExploadUploads = explode('.', $row['name'], 2)[1];
                                        ?>
                                            <div class="centerContentX">
                                                <div class="file">
                                                    <div class="centerY marginSpacer" style="width: 50%;">
                                                        <a href="?file_prev=<?php echo rawurlencode($row['name']) ;?>" style="text-decoration: none;">
                                                            <p class="wordBreak marginSpacer" style="width: 100%; color: black;"><?php echo htmlentities($newFileNameAfterExploadUploads); ?></p>
                                                        </a>
                                                    </div>
                                                    <div class="centerY responsiveDisplayNone" style="width: fit-content; padding-right: 40px;">
                                                        <p style="width: 100%;"><?php echo round($row['size'] / 1000000) . "<span style='font-size: 12px;'>MB</span>"; ?></p>
                                                    </div>
                                                    <div class="centerY marginSpacerCustomMax responsiveDisplayNone dateTimeResponsive" style="width: fit-content; padding-right: 40px;">
                                                        <p style="width: 100%;"><?php echo $row['datePublished']; ?></p>
                                                    </div>
                                                    <div class="centerY manageActionsResponsive" style="width: fit-content;">
                                                        <form id="file_name" action="?fileValueName=<?php echo rawurlencode($row['name']); ?>" method="POST" class="resetCss formValidatePublicSharing resonsiveMargin12px" name='files_form_name' style="margin-top: 4px;">
                                                            <div class="center_content_form_x">
                                                                <select name="setShare" class="selectFormOption" onchange='document.getElementById("formSubmitFileStatus<?php echo rawurlencode($row["name"]); ?>").click();' style="border: 1px solid black; padding: 10px 20px; min-width: 160px;">
                                                                    <option value="<?php echo rawurlencode($row['publicView']); ?>" style="color: black;">Status: <?php echo $row['publicView']; ?></option>
                                                                    <option value="public" style="color: black;">Public</option>
                                                                    <option value="private" style="color: black;">Private</option>
                                                                </select>
                                                                <input style="display: none;" type="submit" value="submit" name="setShareSubmit" id="formSubmitFileStatus<?php echo rawurlencode($row["name"]); ?>" class="resetCss formvalidatebtn">
                                                            </div>
                                                        </form>
                                                        <div style="width: 125px;" class="center_content_x">
                                                            <a href="<?php echo 'class/uploads/' . $userid . '/' . rawurlencode($row['name']) ?>" class="download-btn" download="<?php echo rawurldecode($newFileNameAfterExploadUploads); ?>">
                                                                <i class="fas fa-cloud-download-alt" aria-hidden="true" style="font-size:21px; margin-left:10px; padding-top: 7px; color: #4542ff; text-decoration: none;"></i>
                                                            </a>
                                                            <a href="publicView.php?q=<?php echo rawurlencode($row['name']); ?>&filePublicUid=<?php echo $row['usersid']; ?>">
                                                                <i class="fas fa-share" aria-hidden="true" style="font-size:21px; margin-left:10px; padding: 8px; color:#4542ff; text-decoration: none;" title="share"></i>
                                                            </a>
                                                            <a onclick="<?php echo "a" . $row['id']; ?>confirmFileDelete()" style="text-decoration: none;">
                                                                <i class="fa fa-trash" aria-hidden="true" style="font-size:22px; margin-left:10px; color:#4542ff; padding-top: 7px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="deleteConfirmBackground" id="deleteFileConfirmBackground<?php echo $row['id']; ?>" style="display: none;">
                                                <div class="centerContent">
                                                    <div class="confirmDeleteMain">
                                                        <div class="centerContent">
                                                            <div class="contentDeleteFolderMsg">
                                                                <div class="center_content_x">
                                                                    <p class="applyParaMaxWidth wordBreak" style="text-align:center;">Are you sure you want to delete the file <strong>"<?php echo $newFileNameAfterExploadUploads; ?>"</strong>?<br>
                                                                    once deleted, this file will be deleted forever.</p>
                                                                </div>
                                                            </div>
                                                            <div class="folderDelteManual">
                                                                <div class="center_content_x display-flex-responsive-false">
                                                                    <a href='?delete=<?php echo $row['id'];?>' class="deleteFolderManual btnDelteFolder1" style="text-decoration: none;">Delete</a>
                                                                </div>
                                                                <div class="center_content_x display-flex-responsive-false">
                                                                    <a onclick="<?php echo "a" . $row['id']; ?>confirmFileDelete()" class="cancleboxBtn deleteFolderManual btnDelteFolder2">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <script> 
                                                function <?php echo "a" . $row['id']; ?>confirmFileDelete() {
                                                    var confirmDeleteShowFile = document.getElementById("deleteFileConfirmBackground<?php echo $row['id']; ?>");
                                                                    
                                                    if (confirmDeleteShowFile.style.display === "none") {
                                                        confirmDeleteShowFile.style.display = "block";
                                                    } else {
                                                        confirmDeleteShowFile.style.display = "none";
                                                    }
                                                }
                                            </script>
                                        <?php 
                                    }
                                ?>   
                            </div>                   
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button onclick="uploadshow()" class="button-show" id="c123V2">Upload Files</button>
                    <button onclick="refresh()" class="button-refresh" id="btnrefresh">Refresh</button>
                    <!---->
                    <div class="center_content_x">
                        <div class="dark-bg-custom" id="upload-222" style="display:none;">
                            <form method="post" class="upload-222" id="form-to-upload-222" enctype="multipart/form-data">
                                <center style="margin-top: 100px;" class="center-content-1av">
                                    <h3>Upload Files</h3>
                                    <input type="file" name="myfile[]" id="myfile" class="custom-file-upload-myfile" onchange="checkFileUpload()" multiple><br>
                                    <button type="submit" id="disableIdOnclick" class="button1 upload-confirm-button-styling" name="save" onclick="uploadFile()">Upload</button>
                                    <br>
                                </center>
                                <div class="progressData">
                                    <div class="progressDataTop">
                                        <div class="centerContent dark-bg" id="show-progress-onUpload" style="display: none;">
                                            <div id="hide-upload-progress">
                                                <div class="centerContent" style="margin-top: -40px;">
                                                    <div class="width-max-content">
                                                        <h3>Uploaded:</h3>
                                                    </div>
                                                    <!--<progress id="progressBar" value="0" max="100" style="z-index: 999999999999;"></progress><br>-->
                                                    <div class="centerContentX margin-top-custom-uploadmsg">
                                                        <div class="circle-progress">
                                                            <div id="progress-innerProgress" class="progress-innerProgress" style="width: 0%;">
                                                            </div>
                                                            <h3 id="status" style="z-index: 999999999999;">- %</h3><br>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="loaded_n_total" style="display: none;"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <button class="button-hide" onclick="uploadshow()" id="backbtn" style="display:none;">Back</button>
                    </div>
                </div>
            </div>
            <?php
                $sql = "SELECT * FROM users WHERE userId=?";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    ?>
                        <script>
                            window.location.replace('?err');
                        </script>
                    <?php 
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $userid);
                    mysqli_stmt_execute($stmt);
                }

                $result = mysqli_stmt_get_result($stmt);
                foreach ($result as $row) {
                    $useremail = $row['usersEmail'];
                    $customUserNameUid = $row['usersName'];
                    $usersUsernameOrSignedUser = $row['usersUid'];
                }
            ?>
            <div id="inboxContainer" class="overflowScroll_width1" style="display: none;">
                <div class="centerContentX">
                    <div class="inboxTitle">
                        <h1>Inbox</h1>
                    </div>
                </div>
                <div class="centerContentX">
                    <div class="inboxRequestContainer" style="width: 95%;">
                        <?php 
                            $sql = "SELECT * FROM inbox WHERE sentToUser=? OR sentToUser=?";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                ?>
                                    <script>
                                        window.location.replace('?err');
                                    </script>
                                <?php 
                            } else {
                                mysqli_stmt_bind_param($stmt, "ss", $useremail, $usersUsernameOrSignedUser);
                                mysqli_stmt_execute($stmt);
                            }

                            $result = mysqli_stmt_get_result($stmt);
                            foreach ($result as $row) {
                                ?>
                                    <div class="inboxIncomingRequest" id="inboxFileRequestIndividual<?php echo $row['Id']; ?>">
                                        <div class="centerContentY float_left">
                                            <p><?php echo htmlentities(explode('.', $row['name'], 2)[1]); ?></p>
                                        </div>
                                        <div class="centerContentY float_right responsive_float_left_max_width_custom">
                                            <button class="acceptInboxRequest" onclick="<?php echo "Id" . $row['Id']; ?>AcceptInbox()">Accept</button>
                                        </div>
                                    </div>
                                    <script>
                                        function <?php echo "Id" . $row['Id']; ?>AcceptInbox() {
                                            var inboxAccept = _("inboxAcceptBanner");
                                            var tmpHide = _("inboxFileRequestIndividual<?php echo $row['Id']; ?>");

                                            inboxAccept.style.display = "block";
                                            tmpHide.style.display = "none";
                                            setTimeout(() => {
                                                window.location.replace('?moveInboxFile=<?php echo $row['Id']; ?>&fileMoveName=<?php echo $row['name']; ?>');
                                            }, 1000);
                                        }

                                        function <?php echo "Id" . $row['Id']; ?>AcceptInboxClose() {
                                            inboxAccept.style.display = "none";
                                        }
                                    </script>

                                    <div id="inboxAcceptBanner" style="display: none;">
                                        <div class="centerContent">
                                            <p style="margin: 0;" onclick="<?php echo "Id" . $row['Id']; ?>AcceptInboxClose()">Accepted one incoming request. Processing...</p>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div style="height: 300px; width: 100%;"></div>
                <div class="centerContentX" style="padding-bottom: 200px;">
                    <div class="sentMail">
                        <div class="addSentMailBorder">
                            <h1>Pending</h1>
                        </div>
                        <div>
                            <?php
                                $sql = "SELECT * FROM inbox WHERE usersid=?";
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    ?>
                                        <script>
                                            window.location.replace('?err');
                                        </script>
                                    <?php 
                                } else {
                                    mysqli_stmt_bind_param($stmt, "s", $userid);
                                    mysqli_stmt_execute($stmt);
                                }

                                $result = mysqli_stmt_get_result($stmt);
                                foreach ($result as $row) {
                                    ?>
                                        <div class="inboxIncomingRequest displayBlock" id="inboxFileRequestIndividual<?php echo $row['Id']; ?>">
                                            <div class="centerContentY float_left">
                                                <p><?php echo htmlentities(explode('.', $row['name'], 2)[1]); ?></p>
                                            </div>
                                            <div class="centerContentY float_right">
                                                <button class="acceptInboxRequest" onclick="window.location.replace('?revokeInbox=<?php echo $row['Id']; ?>&revokeInboxName=<?php echo $row['name']; ?>');">Revoke</button>
                                            </div>
                                        </div>
                                    <?php 
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="uplBtn customUplBtnInbox" onclick="inbox()">
                        <p>Back</p>
                    </button>
                </div>
            </div>
            <div class="dark-bg z-index-max" id="sendInboxContainer" style="display: none;">
                <div class="wrapper-ContentSend" id="wrapper-ContentSend">
                    <div class="centerContent">
                        <div class="customFormDiv">
                            <form method="post" enctype="multipart/form-data" class="resetCss customForm">
                                <center>
                                    <h2 style="width: 90%; text-align: left; padding-bottom: 10px;">Send Files</h2>
                                </center>
                                <div class="centerContentX">
                                    <input type="text" name="sendingtouser" id="sendingUidEmail" class="sendToUser-Input" value="" style="margin-bottom: 10px; border-radius: 0;" placeholder="Enter a valid Email Or Username"/>
                                </div>
                                <center style="height: fit-content; padding: 0; margin: 0;"> 
                                    <input type="file" class="select-file_Send" name="myfileCustom[]" id="myfileCustom" onchange="checkFileSizeUploadCustom()" style="border-radius: 0;" multiple><br>
                                </center>
                                <div class="progressData" style="margin-top: 0px;">
                                    <div class="progressDataTop" style="margin-top: 0px;">
                                        <div class="centerContent dark-bg" id="show-progress-onUpload_Custom" style="display: none;">
                                            <div id="hide-upload-progress">
                                                <div class="centerContent" style="margin-top: -40px;">
                                                    <div class="width-max-content">
                                                        <h3>Uploaded:</h3>
                                                    </div>
                                                    <!--<progress id="progressBar_Custom" value="0" max="100" style="z-index: 999999999999;"></progress><br>-->
                                                    <div class="centerContentX margin-top-custom-uploadmsg">
                                                        <div class="circle-progress">
                                                            <div id="progress-innerProgress_Custom" class="progress-innerProgress" style="width: 0%;">
                                                            </div>
                                                            <h3 id="status_Custom" style="z-index: 999999999999;">- %</h3><br>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="loaded_n_total_Custom" style="display: none;"></p>
                                    </div>
                                </div>
                                <div class="createFolderManualContainer asghi2Responsive">
                                    <button type="submit" id="disableIdOnclick" name="sendfile" class="createFolderManual changeMarginSend" onclick="sendFileInbox()" style="border: none;">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button class="uplBtn customUplBtnInbox" onclick="sendToInbox()" id="sendInboxBtnOpen">
                    <p>Back</p>
                </button>
            </div>
    </body>
    <script src="./Dependencies/JS/UPLOAD_FILE/upload-functions-js.js"></script>
    <?php 
    } else {
        ?>
            <script> 
                window.location.href = 'index.php';
            </script>
        <?php           
    } 








