<?php 
    error_reporting(0);
    include_once 'header.php';
    include_once "Dependencies/PHP_CSS/upload.php";
    include_once 'includes/Logging/log-folderPublicView.php';
    include_once 'Dependencies/Error/handler.php';
?>

<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="Dependencies/CSS/loader.css">
</head>
    <?php 
        include_once 'header.php';
        include_once 'includes/dbh.inc.php';
        include 'Dependencies/PHP_CSS/classroom.php';

            if (isset($_GET['foldername'])) {
                $GetUserIdFromFolder = $_GET['folderPublicUid'];
                $folder_get_contentname = $_GET['foldername'];

                ?>
                    <script> 
                        function cancleErrorHandler() {
                            window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname . '&folderPublicUid=' . $GetUserIdFromFolder); ?>&errnone');
                        }
                    </script> 
                <?php 
                
                $sql = "SELECT * FROM folders WHERE usersUid=? AND folderName=? AND publicView=?"; 
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    ?>
                        <script>
                            window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname . '&folderPublicUid=' . $GetUserIdFromFolder); ?>&err');
                        </script>
                    <?php 
                } else {
                    $variablePlainTextPublic = 'public';
                    mysqli_stmt_bind_param($stmt, "sss", $GetUserIdFromFolder, $folder_get_contentname, $variablePlainTextPublic);
                    mysqli_stmt_execute($stmt);
                }

                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) == 0) { 
                    echo '
                    <div class="center_content_x_z_y">
                        <h1>No Results Found</h1>
                    </div>
                    ';
                }
                foreach ($result as $row) {
                    echo '<div class="responsive-text-container">';
                        echo '<h1>' . htmlentities($folder_get_contentname) . '</h1>';
                    echo '</div>';

                    $sql = "SELECT * FROM class_files WHERE usersid=? AND folderParent=?"; 
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                            <script>
                                window.location.replace('?foldername=<?php echo $folder_get_contentname . '&folderPublicUid=' . $GetUserIdFromFolder; ?>&err');
                            </script>
                        <?php 
                    } else {
                        $variablePlainTextPublic = 'public';
                        mysqli_stmt_bind_param($stmt, "ss", $GetUserIdFromFolder, $folder_get_contentname);
                        mysqli_stmt_execute($stmt);
                    }

                    $result = mysqli_stmt_get_result($stmt);

                    echo '<div class="center_content_xCustomFolderPreview">';
                    foreach ($result as $row) {
                        $newFileNameAfterExpload = explode('.', $row['name'], 2)[1];
                        $newFriendlyUrlName = rawurlencode($row['name']);

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
                                if(preg_match('/png|jpg|jpeg|gif|JPG|PNG|GIF|JPEG/', $row['name'])) {
                                    ?>
                                        <div class="SongFolderMaxContentPreview">
                                            <img src="<?php echo 'Class/Uploads/' . $GetUserIdFromFolder . '/' . $newFriendlyUrlName; ?>" class="show_max_folder_content_prevSizeImg">
                                        </div>
                                    <?php 
                                } else if (preg_match('/pdf|docx|PDF|DOCX/', $row['name'])) {
                                    ?>
                                        <object data="<?php echo 'Class/Uploads/' . $GetUserIdFromFolder . '/' . $newFriendlyUrlName; ?>" type="application/pdf" class="show_max_folder_content_prevSizePdf_thumb">
                                            <div class="centerContent">
                                                <h1 style="color: black; text-align: center;">Cannot Display File Types "Pdf, and Docx".</h1>
                                            </div>
                                        </object>
                                    <?php 
                                } else if (preg_match('/html|php|HTML|PHP|txt|TXT/', $row['name'])) {
                                    ?>
                                        <textarea name="file_contents" class="fileContentsPlain-Text_thumb">
                                            <?php 
                                                echo htmlentities(file_get_contents('Class/Uploads/' . $GetUserIdFromFolder . '/' . rawurldecode($newFriendlyUrlName)));
                                            ?>
                                        </textarea>
                                    <?php 
                                } else if (preg_match('/mp3|MP3/', $row['name'])) {
                                    ?>
                                        <div class="SongFolderMaxContentPreview">
                                            <audio id="audioPrevVolumeController" controls>
                                                <source src="class/uploads/<?php echo $GetUserIdFromFolder . '/' . $newFriendlyUrlName; ?>" type="audio/ogg">
                                                <source src="class/uploads/<?php echo $GetUserIdFromFolder . '/' . $newFriendlyUrlName; ?>" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    <?php 
                                } else if (preg_match('/mp4|mov|ogg|MP4|OGG|MOV/', $row['name'])) {
                                    ?>
                                        <video class="show_max_folder_content_prevSize" controls> 
                                            <source src="<?php echo 'class/uploads/' . $GetUserIdFromFolder . '/' . $newFriendlyUrlName; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/mp4">
                                            <source src="<?php echo 'class/uploads/' . $GetUserIdFromFolder . '/' . $newFriendlyUrlName; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/ogg">
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
                                }
                            echo '</div>';
                            echo '<div class="folder_container_view_url">';
                                echo '<a class="href_asda2" href="?foldername=' . rawurlencode($_GET['foldername']) . '&file_prev=' . $newFriendlyUrlName . '&folderPublicUid=' . $_GET['folderPublicUid'] . '" class="a_gr">' . $newFileNameAfterExpload . '</a><br>';
                                echo '<div style="height:10px;"></div>';
                                ?>
                                    <a href="<?php echo 'class/uploads/' . $GetUserIdFromFolder . '/' . $row['name']?>" class="download-btn float_btns_right" style="margin-left: 20px; margin-top: 4px;" download="<?php echo rawurldecode($newFileNameAfterExpload); ?>">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>                                
                                <?php 
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } 

            if (isset($_GET['file_prev'])) {
                $file_prev = rawurlencode($_GET['file_prev']);
                $newFileNameAfterExpload_Full = explode('.', $file_prev, 2)[1];
                    
                $filepath = pathinfo('class/uploads/' . $GetUserIdFromFolder . '/' . $file_prev);
                $cleanFolderName = rawurlencode($_GET['foldername']);
                ?> 
                    <div class="full-frame">
                        <div class="align-items-left">
                            <div class="top-file-info-container">
                                <a href="?foldername=<?php echo $cleanFolderName; ?>&folderPublicUid=<?php echo rawurlencode($_GET['folderPublicUid']); ?>" class="href_close_screen_prev" id="closebtn">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>

                                <p class="file_name"><?php echo htmlentities(rawurldecode($newFileNameAfterExploadUploadsFilePrev)); ?></p>
                            </div>
                            <div class="AlignItemsToCenter">
                                <div class="limit-width-justify">
                                    <?php 
                                        if(preg_match('/png|jpg|jpeg|gif|JPG|PNG/', $file_prev)) {
                                            ?>
                                                <img id="iframe_full_screen_prev" src="<?php echo 'Class/Uploads/' . $GetUserIdFromFolder . '/' . $file_prev; ?>" class="max-width">
                                            <?php 
                                        } else if (preg_match('/pdf|docx|PDF|DOCX/', $file_prev)) {
                                            ?>
                                                <object data="<?php echo 'class/uploads/' . $GetUserIdFromFolder . '/' . $file_prev; ?>" type="application/pdf">
                                                    <div class="centerContent">
                                                        <h1 style="color: white;">Cannot Display File Types "Pdf, and Docx".</h1>
                                                    </div>
                                                </object>
                                            <?php 
                                        } else if (preg_match('/html|php|HTML|PHP|txt|TXT/', $file_prev)) {
                                            ?>
                                                <textarea name="file_contents" class="file_html_show_contents">
                                                    <?php 
                                                        echo htmlentities(file_get_contents('Class/Uploads/' . $GetUserIdFromFolder . '/' . rawurldecode($file_prev)));
                                                    ?>
                                                </textarea>
                                            <?php 
                                        } else if (preg_match('/mp3/', $file_prev)) {
                                            ?>
                                                <audio id="audio_prev_player" controls>
                                                    <source src="class/uploads/<?php echo $GetUserIdFromFolder . '/' . $file_prev; ?>" type="audio/ogg">
                                                    <source src="class/uploads/<?php echo $GetUserIdFromFolder . '/' . $file_prev; ?>" type="audio/mpeg">
                                                </audio>
                                            <?php 
                                        } else if (preg_match('/mp4/', $file_prev)) {
                                            ?>
                                                <video class="max-width max-content" controls> 
                                                    <source src="<?php echo 'class/uploads/' . $GetUserIdFromFolder . '/' . $file_prev; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/mp4">
                                                    <source src="<?php echo 'class/uploads/' . $GetUserIdFromFolder . '/' . $file_prev; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/ogg">
                                                </video>
                                            <?php 
                                        } else if (preg_match('/osz/', $file_prev)) {
                                            ?>
                                                <img src="IMG/OSU/osulogo.png" style="max-height: 40%;"> 
                                            <?php 
                                        } else if (preg_match('/zip/', $file_prev)) {
                                            ?>
                                                <img src="IMG/ZIP/ziplogo.png" style="max-height: 40%;"> 
                                            <?php 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
        ?>

        <style>
            body h1, p {
                margin: 40px;
            }

            .a_gr {
                margin: 40px;
            }

            .responsive-text-container {
                width: 100%;
                word-break: break-all;
            }

            @media only screen and (max-width: 800px) {
                .responsive-text-container h1 {
                    font-size: 20px !important;
                }
            }
        </style>
<?php 



