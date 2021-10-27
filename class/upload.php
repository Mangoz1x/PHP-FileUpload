<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<?php 
    include_once 'Dependencies/PHP_CSS/upload.php';
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';

    if (isset($_SESSION['useruid'])) {
        $conn = mysqli_connect("localhost","root","","mangoz1x");
        $userid = $_SESSION["useruid"];
        $sql = "SELECT * FROM class_files WHERE usersid = ?";
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
        $userfiles = mysqli_fetch_all($result,MYSQLI_ASSOC);

        if (isset($_POST['save'])) {
            function createDir($path, $mode = 0777, $recursive = true) {
                if(file_exists($path)) return true;
                return mkdir($path, $mode, $recursive);
            }
            
            createDir('class/uploads/' . $userid);
            //
            $fileCount = count($_FILES['myfile']['name']);
            for ($i=0;$i<$fileCount;$i++) {
                $totalFileSize = array_sum($_FILES['myfile']['size']);
                $maxFileSize = 500 * 1024 * 1024;

                $fileName = $_FILES["myfile"]["name"]; // The file name
                $fileTmpLoc = $_FILES["myfile"]["tmp_name"][$i]; // File in the PHP tmp folder
                $fileType = $_FILES["myfile"]["type"]; // The type of file it is
                $fileSize = $_FILES["myfile"]["size"][$i]; // File size in bytes
                $fileErrorMsg = $_FILES["myfile"]["error"]; // 0 for false... and 1 for true
                $extension = pathinfo($_FILES['myfile']['name'][$i],PATHINFO_EXTENSION);
                if (!$fileTmpLoc) { // if file not chosen
                    ?>
                        <script>
                            window.location.replace('?nofile');
                        </script>
                    <?php 
                } else if(in_array($extension,['exe', 'EXE'])) { #REMOVE PHP TO PREVENT HARMFULL CODE
                    ?>
                        <script>
                            window.location.replace('?nosupport');
                        </script>
                    <?php 
                } else if ($totalFileSize > $maxFileSize) {
                    ?>
                        <script>
                            window.location.replace('?tolarge');
                        </script>
                    <?php 
                } else {
                    $fileName = md5(time() . $_FILES['myfile']) . '.' . $_FILES['myfile']['name'][$i];

                    date_default_timezone_set('America/New_York');
                    $estTime = date('Y-m-d');

                    $sql = "INSERT INTO class_files (name,size,downloads,usersid,datePublished) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                            <script>
                                window.location.replace('?err');
                            </script>
                        <?php 
                    } else {
                        $zero = 0;

                        mysqli_stmt_bind_param($stmt, "sssss", $fileName, $fileSize, $zero, $userid, $estTime);
                        mysqli_stmt_execute($stmt);
                        ?>
                            <META HTTP-EQUIV="Refresh" Content="0; URL='?'">
                        <?php 
                    }

                    move_uploaded_file($_FILES['myfile']['tmp_name'][$i], 'class/uploads/' . $userid . '/' . $fileName);
                    @apache_setenv('no-gzip', 1);
                    @ini_set('zlib.output_compression', 0);
                    @ini_set('output_buffering', 'Off');
                    @ini_set('implicit_flush', 1);
                                    
                    ob_implicit_flush(1);
                    ob_end_flush();
                    ?>
                        <div class="center_content_x_z_y uploading-status"><div id="loading"><h2>Uploading...</h2></div></div>
                    <?php
                                    
                    echo str_repeat(" ", 1024), "\n";
                                    
                    ob_start();
                    sleep(1); 
                    echo "Uploaded";

                    ob_flush();
                    flush();
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

        if (isset($_POST['sendfile'])) {
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
                $selfUserUid = $row['usersUid'];
        
                $sql = "SELECT * FROM users";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    ?>
                        <script>
                            window.location.replace('?err');
                        </script>
                    <?php 
                } else {
                    mysqli_stmt_execute($stmt);
                }

                $result = mysqli_stmt_get_result($stmt);            
                foreach ($result as $row) {
                    $getAllUserNames = $row['usersUid'];

                    if ($_POST['sendingtouser'] === "") {
                        ?>
                            <script>
                                window.location.replace('?nouser');
                            </script>
                        <?php
                    } else if ($_POST['myfileCustom'] === "") {
                        ?>
                            <script>
                                window.location.replace('?nofile');
                            </script>
                        <?php
                    }
                    
                    $sql = "SELECT * FROM users WHERE usersEmail=? OR usersUid=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                            <script>
                                window.location.replace('?err');
                            </script>
                        <?php 
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $_POST['sendingtouser'], $_POST['sendingtouser']);
                        mysqli_stmt_execute($stmt);
                    }
                    $result = mysqli_stmt_get_result($stmt);  
                        
                    if (mysqli_num_rows($result)==0) { 
                        ?>
                            <script>
                                window.location.replace('?dbnone&nfuser=<?php echo rawurlencode($_POST['sendingtouser']); ?>');
                            </script>
                        <?php 
                        mysqli_stmt_close($stmt);
                        mysqli_close($conn);
                    } else {
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
                            $useremailSetStmt = $row['usersEmail'];
                        }
            
                        if ($useremailSetStmt === $_POST['sendingtouser']) {
                            ?>
                                <script> 
                                    window.location.replace('?selfsend');
                                </script> 
                            <?php 
                        } else if ($selfUserUid === $_POST['sendingtouser']) {
                            ?>
                                <script> 
                                    window.location.replace('?selfsend');
                                </script> 
                            <?php 
                        } else {
                            function createDir($path, $mode = 0777, $recursive = true) {
                                if(file_exists($path)) return true;
                                return mkdir($path, $mode, $recursive);
                            }
                            
                            createDir('class/uploads/' . $userid);
                            //
                            $fileCount = count($_FILES['myfileCustom']['name']);
                            for ($i=0;$i<$fileCount;$i++) {
                                $totalFileSize = array_sum($_FILES['myfileCustom']['size']);
                                $maxFileSize = 500 * 1024 * 1024;

                                $fileName = $_FILES["myfileCustom"]["name"]; // The file name
                                $fileTmpLoc = $_FILES["myfileCustom"]["tmp_name"][$i]; // File in the PHP tmp folder
                                $fileType = $_FILES["myfileCustom"]["type"]; // The type of file it is
                                $fileSize = $_FILES["myfileCustom"]["size"][$i]; // File size in bytes
                                $fileErrorMsg = $_FILES["myfileCustom"]["error"]; // 0 for false... and 1 for true
                                $sendingToUser = $_POST['sendingtouser'];
                                $extension = pathinfo($_FILES['myfileCustom']['name'][$i],PATHINFO_EXTENSION);
                                if (!$fileTmpLoc) { // if file not chosen
                                    ?>
                                        <script>
                                            window.location.replace('?nofile');
                                        </script>
                                    <?php 
                                } else if(in_array($extension,['exe', 'EXE'])) { #REMOVE PHP TO PREVENT HARMFULL CODE
                                    ?>
                                        <script>
                                            window.location.replace('?err');
                                        </script>
                                    <?php 
                                }
                                elseif ($totalFileSize > $maxFileSize)
                                {
                                    ?>
                                        <script>
                                            window.location.replace('?tolarge');
                                        </script>
                                    <?php 
                                } else {
                                    $fileName = md5(time() . $_FILES['myfileCustom']) . '.' . $_FILES['myfileCustom']['name'][$i];
                
                                    date_default_timezone_set('America/New_York');
                                    $estTime = date('Y-m-d');
                
                                    $sql = "INSERT INTO inbox (name,sentToUser,size,usersid,dateRequest) VALUES (?, ?, ?, ?, ?)";
                                    $stmt = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                                        ?>
                                            <script>
                                                window.location.replace('?err');
                                            </script>
                                        <?php 
                                    } else {
                                        mysqli_stmt_bind_param($stmt, "sssss", $fileName, $sendingToUser, $fileSize, $userid, $estTime);
                                        mysqli_stmt_execute($stmt);
                                        ?>
                                            <META HTTP-EQUIV="Refresh" Content="0; URL='?'">
                                        <?php 
                                    }
                
                                    move_uploaded_file($_FILES['myfileCustom']['tmp_name'][$i], 'class/uploads/' . $userid . '/' . $fileName);
                                    @apache_setenv('no-gzip', 1);
                                    @ini_set('zlib.output_compression', 0);
                                    @ini_set('output_buffering', 'Off');
                                    @ini_set('implicit_flush', 1);
                                                    
                                    ob_implicit_flush(1);
                                    ob_end_flush();
                                    ?>
                                        <div class="center_content_x_z_y uploading-status"><div id="loading"><h2>Sending...</h2></div></div>
                                    <?php
                                                    
                                    echo str_repeat(" ", 1024), "\n";
                                                    
                                    ob_start();
                                    sleep(1); 
                                    echo "Sent";
                
                                    ob_flush();
                                    flush();
                                }
                            }
                            mysqli_stmt_close($stmt);
                            mysqli_close($conn);
                        }
                    }
                }
            }
        }

        if (isset($_GET['revokeInbox'])) {
            $revokeId = $_GET['revokeInbox'];
            $revokeFileName = $_GET['revokeInboxName'];

            $sql = "DELETE FROM inbox WHERE usersid=? AND Id=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?err');
                    </script>
                <?php 
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $userid, $revokeId);
                mysqli_stmt_execute($stmt);

                unlink("class/uploads/$userid/$revokeFileName");

                @apache_setenv('no-gzip', 1);
                @ini_set('zlib.output_compression', 0);
                @ini_set('output_buffering', 'Off');
                @ini_set('implicit_flush', 1);
                                            
                ob_implicit_flush(1);
                ob_end_flush();
                    ?>
                        <div class="center_content_x_z_y uploading-status"><div id="loading"><h2>Revoking Access...</h2></div></div>
                    <?php
                                            
                echo str_repeat(" ", 1024), "\n";
                                            
                ob_start();
                sleep(1); 
                echo "Revoking";
        
                ob_flush();
                flush();

                ?>
                    <META HTTP-EQUIV="Refresh" Content="0; URL='?'">
                <?php 
            }
        }

        if (isset($_GET['moveInboxFile'])) {
            function createDir($path, $mode = 0777, $recursive = true) {
                if(file_exists($path)) return true;
                return mkdir($path, $mode, $recursive);
            }

            createDir('class/uploads/' . $userid);
            
            $moveInboxFile = $_GET['moveInboxFile'];
            $moveInboxFileName = $_GET['fileMoveName'];

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
                $personalUserNameGet = $row['usersUid'];
            }

            $sql = "SELECT * FROM inbox WHERE sentToUser=? OR sentToUser=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?err');
                    </script>
                <?php 
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $useremail, $personalUserNameGet);
                mysqli_stmt_execute($stmt);
            }
            $result = mysqli_stmt_get_result($stmt);              
            foreach ($result as $row) {
                $sentFromUserUid = $row['usersid'];
                $getSizeFromTable = $row['size'];
                $getIdFromTable = $row['Id'];
                
                $csvFile = "class/uploads/$sentFromUserUid/$moveInboxFileName";
                $moveFile = "class/uploads/$userid/$moveInboxFileName";

                if (copy($csvFile,$moveFile)) {
                    $sql = "INSERT INTO class_files (name,size,downloads,usersid,datePublished) VALUES (?, ?, ?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                            <script>
                                window.location.replace('?err');
                            </script>
                        <?php 
                    } else {
                        date_default_timezone_set('America/New_York');
                        $estTime = date('Y-m-d');

                        $zero = 0;

                        mysqli_stmt_bind_param($stmt, "sssss", $moveInboxFileName, $getSizeFromTable, $zero, $userid, $estTime);
                        mysqli_stmt_execute($stmt);
                    }

                    $sql = "DELETE FROM inbox WHERE usersid=? AND name=?";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                            <script>
                                window.location.replace('?err');
                            </script>
                        <?php 
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $sentFromUserUid, $moveInboxFileName);
                        mysqli_stmt_execute($stmt); 
                    }

                    unlink($csvFile);

                    ?>
                        <META HTTP-EQUIV="Refresh" Content="0; URL='?'">
                    <?php 
                }
            }
        }

        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $userid = $_SESSION["useruid"];

            $conn = mysqli_connect("localhost", "root", "", "mangoz1x");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // VARIABLES TO DELETE FILE NAME WITH UNLINK FUNCTION
            $sql = "SELECT * FROM class_files WHERE id=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?err');
                    </script>
                <?php 
            } else {
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                
                $result = mysqli_stmt_get_result($stmt);
                if (!$row = mysqli_fetch_assoc($result)) {
                    ?>
                        <script>
                            window.location.replace('?err');
                        </script>
                    <?php 
                } else {  
                    unlink('class/uploads/' . $userid . '/' . rawurlencode($row['name']));

                    ?>
                        <META HTTP-EQUIV="Refresh" Content="0; URL='?'">
                    <?php 
                }

                @apache_setenv('no-gzip', 1);
                @ini_set('zlib.output_compression', 0);
                @ini_set('output_buffering', 'Off');
                @ini_set('implicit_flush', 1);
                                    
                ob_implicit_flush(1);
                ob_end_flush();
                    ?>
                        <div class="centerContent uploading-status" style="position: fixed; top: 0; left: 0; z-index: 999999999; background-color: white;"><div id="loading"><h2>Deleting...</h2></div></div>
                    <?php
                                    
                echo str_repeat(" ", 1024), "\n";
                                    
                ob_start();
                sleep(1); 
                echo "Deleted";

                ob_flush();
                flush();

            }
            
            // sql to delete a record
            $sql = "DELETE FROM class_files WHERE usersid=? AND id=?";
            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?err');
                    </script>
                <?php 
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $userid, $id);
                mysqli_stmt_execute($stmt);

                ?>
                    <META HTTP-EQUIV="Refresh" Content="0; URL='?'">
                <?php 
            }
                        
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

        if (isset($_GET['folderdelete'])) {
            $folderid = $_GET['folderdelete'];
            $userid = $_SESSION["useruid"];
            $foldernameid = $_GET['folderdeletename'];

            $conn = mysqli_connect("localhost", "root", "", "mangoz1x");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // VARIABLES TO DELETE FILE NAME WITH UNLINK FUNCTION
            //$sql = "SELECT * FROM folders WHERE id=$folderid";
            //$result = mysqli_query($conn, $sql);
            //$file = mysqli_fetch_assoc($result);
            
            // sql to delete a record
            $sql = "DELETE FROM folders WHERE usersUid=? AND id=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?err');
                    </script>
                <?php 
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $userid, $folderid);
                mysqli_stmt_execute($stmt);
                
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?' . '">';
            }

            $sql = "UPDATE class_files SET folderParent=? WHERE folderParent=?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                ?>
                    <script>
                        window.location.replace('?err');
                    </script>
                <?php 
            } else {
                $blankSpace = '';

                mysqli_stmt_bind_param($stmt, "ss", $blankSpace, $foldernameid);
                mysqli_stmt_execute($stmt);
                
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?' . '">';

                @apache_setenv('no-gzip', 1);
                @ini_set('zlib.output_compression', 0);
                @ini_set('output_buffering', 'Off');
                @ini_set('implicit_flush', 1);
                                    
                ob_implicit_flush(1);
                ob_end_flush();
                    ?>
                        <div class="centerContent uploading-status" style="position: fixed; top: 0; left: 0; z-index: 999999999; background-color: white;"><div id="loading"><h2>Deleting Folder...</h2></div></div>
                    <?php
                                    
                echo str_repeat(" ", 1024), "\n";
                                    
                ob_start();
                sleep(1); 
                echo "Deleted";

                ob_flush();
                flush();
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }

        if (isset($_GET['cfolder'])) {
            if (empty($_GET['cfolder'])) {
                ?>
                    <script>
                        window.location.replace('?nfoldername');
                    </script>
                <?php 
            } else {
                $folder_name = rawurlencode($_GET['cfolder']);
                $folderNameDecide = urldecode($_GET['cfolder']);

                $sql = "SELECT * FROM folders WHERE usersUid=? AND folderName=?"; 
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    ?>
                        <script>
                            window.location.replace('?err');
                        </script>
                    <?php 
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $userid, $folderNameDecide);
                    mysqli_stmt_execute($stmt);
                }

                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    ?>
                        <script>
                            window.location.replace('?doublef&fname=<?php echo $_GET['cfolder']; ?>');
                        </script>
                    <?php 
                } else {
                    $sql = "INSERT INTO folders (folderName, usersUid, sharing) 
                    VALUES(?, ?, ?)";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                            <script>
                                window.location.replace('?err');
                            </script>
                        <?php 
                        exit();
                    } else {
                        $trueMysqliBindParamStmt = 'true';
                        mysqli_stmt_bind_param($stmt, "sss", $folderNameDecide, $userid, $trueMysqliBindParamStmt);
                        mysqli_stmt_execute($stmt);

                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?errnone' . '">';
                    }
                }
            }
        }

        if (isset($_GET['file_prev'])) {
            $file_prev = rawurlencode($_GET['file_prev']);
            
            $filepath = pathinfo('Class/Uploads/' . $userid . '/' . $file_prev);
            $newFileNameAfterExploadUploadsFilePrev = explode('.', $file_prev, 2)[1];

            ?> 
                <div class="full-frame">
                    <div class="align-items-left">
                        <div class="top-file-info-container">
                            <a href="?" class="href_close_screen_prev" id="closebtn">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>

                            <p class="file_name"><?php echo htmlentities(rawurldecode($newFileNameAfterExploadUploadsFilePrev)); ?></p>
                        </div>
                        <div class="AlignItemsToCenter">
                            <div class="limit-width-justify">
                                <div class="loader-wrapper" style="z-index: 999999999999999;">
                                    <span class="loader"><span class="loader-inner"></span></span>
                                </div>
                                <script>
                                    $(window).on("load",function(){
                                        $(".loader-wrapper").fadeOut("slow");
                                    });
                                </script>
                                <?php 
                                    if(preg_match('/png|jpg|jpeg|gif|JPG|PNG/', $file_prev)) {
                                        ?>
                                            <img id="iframe_full_screen_prev" src="<?php echo 'Class/Uploads/' . $userid . '/' . $file_prev; ?>" class="max-width">
                                        <?php 
                                    } else if (preg_match('/pdf|docx|PDF|DOCX/', $file_prev)) {
                                        ?>
                                            <object data="<?php echo 'class/uploads/' . $userid . '/' . $file_prev; ?>" type="application/pdf">
                                                <div class="centerContent">
                                                    <h1 style="color: white;">Cannot Display File Types "Pdf, and Docx".</h1>
                                                </div>
                                            </object>
                                        <?php 
                                    } else if (preg_match('/html|php|HTML|PHP|txt|TXT/', $file_prev)) {
                                        ?>
                                            <textarea name="file_contents" class="file_html_show_contents">
                                                <?php 
                                                    echo htmlentities(file_get_contents('class/uploads/' . $userid . '/' . rawurldecode($file_prev)));
                                                ?>
                                            </textarea>
                                        <?php 
                                    } else if (preg_match('/mp3/', $file_prev)) {
                                        ?>
                                            <audio id="audio_prev_player" controls>
                                                <source src="class/uploads/<?php echo $userid . '/' . $file_prev; ?>" type="audio/ogg">
                                                <source src="class/uploads/<?php echo $userid . '/' . $file_prev; ?>" type="audio/mpeg">
                                            </audio>
                                        <?php 
                                    } else if (preg_match('/mp4/', $file_prev)) {
                                        ?>
                                            <video class="max-width max-content" controls> 
                                                <source src="<?php echo 'class/uploads/' . $userid . '/' . $file_prev; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/mp4">
                                                <source src="<?php echo 'class/uploads/' . $userid . '/' . $file_prev; ?>" id="iframe_full_screen_prev" class="iframe_full_screen_prev" type="video/ogg">
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
                                    } else {
                                        ?>
                                            <h1 style="color: lightgrey; text-align: center;">Oops, Looks like we cant preview this file!</h1>
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
        <script src="./Dependencies/JS/UPLOAD_LOGIC_FILE/functions-js.js"></script>
        <?php
    }


