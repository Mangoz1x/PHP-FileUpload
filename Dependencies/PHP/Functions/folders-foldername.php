<?php 
    if (isset($_GET['foldername'])) {
        //GET THE FOLDER NAME
        $folder_get_contentname = $_GET['foldername'];

        //MAKE THE SQL QUERY
        $sql = "SELECT * FROM folders WHERE usersUid=? AND folderName=?"; 
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            ?>
                <script>
                    window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&err');
                </script>
            <?php 
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $useruid, $folder_get_contentname);
            mysqli_stmt_execute($stmt);
        }

        //GET SQL QUERY RESULTS & ERROR HANDLE
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 0) { 
            echo '
                <div class="center_content_x_z_y">
                    <h1>No Results Found</h1>
                </div>
            ';
        } else {
            checkIfFolderIsValid();
        }

        //WHILE TRUE LOOP 
        foreach ($result as $row) {
            //DISPLAY THE FOLDER NAME
            echo '<div class="responsive-text-container">';
                echo '<h1>' . htmlentities($folder_get_contentname) . '</h1>';
            echo '</div>';

            //MAKE ANOTHER SQL QUERY
            $sql = "SELECT * FROM class_files WHERE usersid=? AND folderParent=?"; 
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&err');
                    </script>
                <?php 
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $useruid, $folder_get_contentname);
                mysqli_stmt_execute($stmt);
            }

            //GET QUERY RESULTS
            $result = mysqli_stmt_get_result($stmt); 
            echo '<div class="center_content_xCustomFolderPreview">'; 
            foreach ($result as $row) {
                //VARIABLES
                $newFileNameAfterExpload = explode('.', $row['name'], 2)[1];
                $newFriendlyUrlName = rawurlencode($row['name']);

                //CHECK EXTENSIONS AND DISPLAY DIFFERENT THINGS
                echo '<div class="wrapDivContent_FullWrap">';
                    echo '<div class="show_folder_item_preview">';
                        ?>
                            <div class="loader-wrapper">
                                <span class="loader"><span class="loader-inner"></span></span>
                            </div>
                            <script>
                                $(window).on("load",function(){
                                    $(".loader-wrapper").fadeOut("slow");
                                });
                            </script>
                        <?php 
                        if (preg_match('/png|jpg|jpeg|gif|JPG|PNG|GIF|JPEG/', $row['name'])) {
                            ?>
                                <div class="SongFolderMaxContentPreview">
                                    <img src="<?php echo 'Class/Uploads/' . $useruid . '/' . $newFriendlyUrlName; ?>" class="show_max_folder_content_prevSizeImg">
                                </div>
                            <?php 
                        } else if (preg_match('/pdf|docx|PDF|DOCX/', $row['name'])) {
                            ?>
                                <object data="<?php echo 'Class/Uploads/' . $useruid . '/' . $newFriendlyUrlName; ?>" type="application/pdf" class="show_max_folder_content_prevSizePdf_thumb">
                                    <div class="centerContent">
                                        <h1 style="color: black; text-align: center;">Cannot Display File Types "Pdf, and Docx".</h1>
                                    </div>
                                </object>
                            <?php 
                        } else if (preg_match('/html|php|HTML|PHP|txt|TXT/', $row['name'])) {
                            ?>
                                <textarea name="file_contents" class="fileContentsPlain-Text_thumb">
                                    <?php 
                                        echo htmlentities(file_get_contents('Class/Uploads/' . $useruid . '/' . rawurldecode($newFriendlyUrlName)));
                                    ?>
                                </textarea>
                            <?php 
                        } else if (preg_match('/mp3|MP3/', $row['name'])) {
                            ?>
                                <div class="SongFolderMaxContentPreview">
                                    <audio id="audioPrevVolumeController" controls>
                                        <source src="class/uploads/<?php echo $useruid . '/' . $newFriendlyUrlName; ?>" type="audio/ogg">
                                        <source src="class/uploads/<?php echo $useruid . '/' . $newFriendlyUrlName; ?>" type="audio/mpeg">
                                    </audio>
                                </div>
                            <?php 
                        } else if (preg_match('/mp4|mov|ogg|MP4|OGG|MOV/', $row['name'])) {
                            ?>
                                <video class="show_max_folder_content_prevSize" controls> 
                                    <source src="<?php echo 'class/uploads/' . $useruid . '/' . $newFriendlyUrlName; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/mp4">
                                    <source src="<?php echo 'class/uploads/' . $useruid . '/' . $newFriendlyUrlName; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/ogg">
                                </video>
                            <?php 
                        } else if (preg_match('/osz/', $row['name'])) {
                            ?>
                                <div class="SongFolderMaxContentPreview">
                                    <img src="IMG/OSU/osulogo.png" class="osuLogoPng"> 
                                </div>
                            <?php 
                        } else if (preg_match('/zip/', $row['name'])) {
                            ?>
                                <div class="SongFolderMaxContentPreview">
                                    <img src="IMG/ZIP/ziplogo.png" class="osuLogoPng" style="max-height: 40%;"> 
                                </div>
                            <?php 
                        } else {
                            ?>
                                <div class="SongFolderMaxContentPreview">
                                    <h2>Looks like we cant display this kind of file.</h2>
                                </div>
                            <?php 
                        }
                    echo '</div>';
                echo '<div class="folder_container_view_url">';
                    echo '<a class="href_asda2" href="?foldername=' . rawurlencode($_GET['foldername']) . '&file_prev=' . $newFriendlyUrlName . '" class="a_gr">' . htmlentities($newFileNameAfterExpload) . '</a><br>';
                    echo '<div style="height:10px;"></div>';
                        ?>
                            <a onclick="<?php echo "a" . $row['id']; ?>confirmFileDelete()" style="text-decoration: none; float: right;" class="float_btns_right">
                                <i class="fa fa-trash" aria-hidden="true" style="font-size:22px; margin-left:10px; color:#4542ff;"></i>
                            </a>
                            <a href="<?php echo 'class/uploads/' . $useruid . '/' . $newFriendlyUrlName ?>" class="download-btn float_btns_right" style="margin-left: 10px; margin-top: 4px;" download="<?php echo rawurldecode($newFileNameAfterExpload); ?>">
                                <i class="fas fa-cloud-download-alt" aria-hidden="true" style="color:#4542ff;"></i>
                            </a>                                
                        <?php 
                    echo '</div>';
                echo '</div>';
                ?>
                    <div class="deleteConfirmBackground" id="deleteFileConfirmBackground<?php echo $row['id']; ?>" style="display: none;">
                        <div class="centerContent">
                            <div class="confirmDeleteMain">
                                <div class="centerContent">
                                    <div class="contentDeleteFolderMsg">
                                        <div class="center_content_x">
                                            <p class="applyParaMaxWidth" style="text-align:center;">Are you sure you want to delete the file <strong>"<?php echo htmlentities($newFileNameAfterExpload); ?>"</strong>?<br>
                                            once deleted, this file will be deleted forever.</p>
                                        </div>
                                    </div>
                                    <div class="folderDelteManual">
                                        <div class="center_content_x display-flex-responsive-false">
                                            <a href='?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&fdelete=<?php echo $row['id'];?>' class="deleteFolderManual btnDelteFolder1" style="text-decoration: none;">Delete</a>
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
        }
        echo '</div>';
    } 
?>