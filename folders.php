<?php
    //DONT REPORT ERRORS TO USER & INCLUDE MORE DATA
    error_reporting(0);
    include_once "header.php";
    include_once "class/upload.php";

    //CHECK FOR A FOLDER NAME THEN CHECK FOR A SESSION
    if (isset($_GET['foldername'])) {
        if (isset($_SESSION["useruid"])) {
            //GET THE LOGGED IN USER / GET USER SESSION ID
            $useruid = $_SESSION["useruid"];

            //INCLUDE BACKEND FILES & FRONT END
            include_once "Dependencies/PHP_CSS/upload.php";
            include_once "includes/Logging/log-folders.php";
            include_once "includes/dbh.inc.php";
            include_once "Dependencies/PHP_CSS/classroom.php";
            include_once "Dependencies/Error/handler.php";

            //CODE STARTS
            ?>
                <head>
                    <link rel="stylesheet" type="text/css" href="Dependencies/CSS/loader.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <link rel="stylesheet" href="Dependencies/CSS/upload-responsive.css">
                    <link rel="stylesheet" href="Dependencies/CSS/folders-private-css.css">
                    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script src="./Dependencies/JS/folder-upload-logic.js"></script>
                </head>
                <body>
                    <div class="row">
                        <?php
                            function checkIfFolderIsValid() {
                                ?>
                                    <button onclick="uploadshow()" class="button-show" id="c123V2">Upload Files</button>
                                    <button onclick="refresh()" class="button-refresh" id="btnrefresh">Refresh</button>
                                    <button onclick="backtohome()" class="button-refresh" id="backtohomebtn" style="left: 262px;">Home</button>
                                <?php
                            }
                        ?>

                        <!---->

                        <div class="center_content_x">
                            <div class="dark-bg-custom" id="upload-222" style="display:none;">
                                <form method="post" class="upload-222" id="form-to-upload-222" enctype="multipart/form-data">
                                    <center style="margin-top: 100px;" class="center-content-1av">
                                        <h3>Upload Files</h3>
                                        <input type="file" name="myfile[]" id="myfile" onchange="checkFileSize()" multiple><br>
                                        <button type="submit" id="pleasewaitmsgonclick" class="button1" name="savefolder" onclick="uploadFile()">Upload</button>
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
                </body>
                <script src="./Dependencies/JS/folders-functions.js"></script>
            <?php 
            //INCLUDE FUNCTION FILES AT THE END
            include_once "Dependencies/PHP/Functions/folders-file_prev.php";
            include_once "Dependencies/PHP/Functions/folders-foldername.php";
            include_once "Dependencies/PHP/Functions/folders-savefolder.php";
            include_once "Dependencies/PHP/Functions/functions-fdelete.php";

        } else { echo '<meta http-equiv="refresh" content="0;url=index.php" />'; }
    } else { echo '<meta http-equiv="refresh" content="0;url=upload.php" />'; }
?>
    

              


