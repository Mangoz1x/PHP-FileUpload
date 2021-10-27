 <?php 
    error_reporting(0);
    include_once "header.php";
    include_once "includes/dbh.inc.php";
    include_once 'includes/Logging/log-publicView.php';
    include_once 'Dependencies/Error/handler.php';

    $publicViewName = $_GET['q'];
    $filePublicUidGet = $_GET['filePublicUid'];

    ?>
        <head>
            <link rel="stylesheet" type="text/css" href="Dependencies/CSS/loader.css">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        </head>
        <script> 
            function cancleErrorHandler() {
                window.location.replace('?q=<?php echo $publicViewName . '&filePublicUid=' . $filePublicUidGet; ?>&errnone');
            }
        </script> 
    <?php 

    $sql = "SELECT * FROM class_files WHERE publicView=? AND name=? AND usersid=?"; 
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        ?>
            <script>
                window.location.replace('?q=<?php echo $publicViewName . '&filePublicUid=' . $filePublicUidGet; ?>&err');
            </script>
        <?php 
    } else {
        $variablePlainTextPrivate = 'private';
        mysqli_stmt_bind_param($stmt, "sss", $variablePlainTextPrivate, $publicViewName, $filePublicUidGet);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $row) {
        echo "<div class='center_content_alldir'>";
            echo "<h2>This File Is Private</h2>";
        echo "</div>";
    }

    //###
    $sql = "SELECT * FROM class_files WHERE publicView=? AND name=? AND usersid=?"; 
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        ?>
            <script>
                window.location.replace('?q=<?php echo $publicViewName . '&filePublicUid=' . $filePublicUidGet; ?>&err');
            </script>
        <?php 
    } else {
        $variablePlainTextPublic = 'public';
        mysqli_stmt_bind_param($stmt, "sss", $variablePlainTextPublic, $publicViewName, $filePublicUidGet);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $row) {
        $useruid = $row['usersid'];
        ?>
        <div class="centerContent">
            <div class="contentBoxS">
                <div class="content-Container" style="min-height: 400px;">
                    <div class="loader-wrapper">
                        <span class="loader"><span class="loader-inner"></span></span>
                    </div>
                    <script>
                        $(window).on("load",function(){
                            $(".loader-wrapper").fadeOut("slow");
                            $(".frameContent").css("display", "flex");
                        });
                    </script>
                    <div class="frameContent" style="display: none;">
                        <?php 
                            if(preg_match('/png|jpg|jpeg|gif|JPG|PNG|GIF|JPEG/', $publicViewName)) {
                                ?>
                                    <img id="iframe_full_screen_prev" class="max-content" src="<?php echo 'Class/Uploads/' . $useruid . '/' . rawurlencode($publicViewName); ?>">
                                <?php 
                            } else if (preg_match('/pdf|docx|PDF|DOCX/', $publicViewName)) {
                                ?>
                                    <object data="<?php echo 'Class/Uploads/' . $useruid . '/' . rawurlencode($publicViewName); ?>" type="application/pdf" class="">
                                        <div class="centerContent">
                                            <h1 style="color: black; text-align: center;">Cannot Display File Types "Pdf, and Docx".</h1>
                                        </div>
                                    </object>
                                <?php 
                            } else if (preg_match('/html|php|HTML|PHP|txt|TXT/', $publicViewName)) {
                                ?>
                                    <textarea class="fileContentsPlain-Text_publicView">
                                        <?php 
                                            echo htmlentities(file_get_contents('class/Uploads/' . $useruid . '/' . rawurldecode($publicViewName)));
                                        ?>
                                    </textarea>
                                <?php 
                            } else if (preg_match('/mp3|MP3/', $publicViewName)) {
                                ?>
                                    <audio id="audio_prev_player" class="padding-top-bottom" controls>
                                        <source src="class/uploads/<?php echo $useruid . '/' . rawurlencode($publicViewName); ?>" type="audio/ogg">
                                        <source src="class/uploads/<?php echo $useruid . '/' . rawurlencode($publicViewName); ?>" type="audio/mpeg">
                                    </audio>
                                <?php 
                            } else if (preg_match('/mp4|mov|ogg|MP4|OGG|MOV/', $publicViewName)) {
                                ?>
                                    <video class="max-content" controls> 
                                        <source src="<?php echo 'class/uploads/' . $useruid . '/' . rawurlencode($publicViewName); ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/mp4">
                                        <source src="<?php echo 'class/uploads/' . $useruid . '/' . rawurlencode($publicViewName); ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/ogg">
                                    </video>
                                <?php 
                            } else if (preg_match('/osz/', $publicViewName)) {
                                ?>
                                    <img src="IMG/OSU/osulogo.png" style="max-height: 40%; background-color: #303030; border-radius: 100%;">
                                <?php 
                            } else if (preg_match('/zip/', $publicViewName)) {
                                ?>
                                    <img src="IMG/ZIP/ziplogo.png" style="max-height: 40%;">
                                <?php 
                            } else {
                                ?>
                                    <div class="center_content_alldir">
                                        <h2>Oops, unfortunatly we can not display this file!</h2>
                                    </div>
                                <?php 
                            }
                        ?>
                    </div> 
                </div>
                <div class="download-DownloadBtn">
                    <div class="float-itemLeft-Name">
                        <?php
                            $newFileName = explode('.', $_GET['q'], 2)[1]; 

                            echo '<p>' . $newFileName . '</p>'
                        ?>
                    </div>
                    <a href="class/uploads/<?php echo $useruid . '/' . rawurlencode($publicViewName); ?>" class="a-container" download="<?php echo rawurldecode($newFileName); ?>">
                        <i class="fas fa-cloud-download-alt custom-fas-icon" aria-hidden="true" style="color: #4542ff;"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
    }
    if (mysqli_num_rows($result) == 0) { 
        echo '
        <div class="center_content_alldir">
            <h1>No Results Found</h1>
        </div>
        ';
    }
?>

<style> 
    .padding-top-bottom {
        padding-top: 100px;
        padding-bottom: 100px;
    }
    .centerContent {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        flex-direction: column;
    }

    .contentBoxS {
        display: flex;
        box-shadow: 0px 0px 10px 0px #000000;
        width: 75%;
        max-height: 75%;
        height: fit-content;
        flex-direction: column;
    }

    .content-Container {
        width: 100%;
        height: fit-content;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        overflow: hidden;
        background-color: #404040;
        position: relative;
    }

    .frameContent {
        width: 100%;
        height: 100%;
        min-height: 30vh;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeinoncontent 1s;
    }

    @keyframes fadeinoncontent {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .max-content {
        max-width: 100%;
        max-height: 100%;
    }

    .download-DownloadBtn {
        width: 100%;
        height: 60px;
        border-top: 1px solid black;
    }

    .a-container {
        height: 100%;
        display: flex;
        align-items: center;
        float: right;
    }

    .custom-fas-icon {
        margin-right: 30px;
        float: left;
    }

    .float-itemLeft-Name {
        height: 100%;
        float: left;
        display: flex;
        align-items: center;
        max-width: 55%;
    }

    .float-itemLeft-Name p {
        width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-left: 30px;
    }

    .center_content_alldir {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fileContentsPlain-Text_publicView {
        border: none;
        width: 100%;
        height: 100%;
        outline: none;
    }
</style> 
