<?php 
    if (isset($_POST['savefolder'])) {
        function createDir($path, $mode = 0777, $recursive = true) {
            if(file_exists($path)) return true;
            return mkdir($path, $mode, $recursive);
        }

        //CREATE DIRECTORY FOR USER IF IT DOESNT EXIST
        createDir('class/uploads/' . $userid);

        //COUNT THE FILES AND CREATE A FOR EACH LOOP
        $fileCount = count($_FILES['myfile']['name']);
        for ($i=0;$i<$fileCount;$i++) {
            $totalFileSize = array_sum($_FILES['myfile']['size']);
            $maxFileSize = 500 * 1024 * 1024;

            //GET FILE INFO
            $fileName = $_FILES["myfile"]["name"]; // The file name
            $fileTmpLoc = $_FILES["myfile"]["tmp_name"][$i]; // File in the PHP tmp folder
            $fileType = $_FILES["myfile"]["type"]; // The type of file it is
            $fileSize = $_FILES["myfile"]["size"][$i]; // File size in bytes
            $fileErrorMsg = $_FILES["myfile"]["error"]; // 0 for false... and 1 for true
            $extension = pathinfo($_FILES['myfile']['name'][$i],PATHINFO_EXTENSION);

            //ERROR HANDLERS
            if (!$fileTmpLoc) { 
                ?>
                    <script>
                        window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&nofile');
                    </script>
                <?php 
            } else if(in_array($extension,['exe', 'EXE'])) { 
                ?>
                    <script>
                        window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&nosupport');
                    </script>
                <?php 
            } elseif ($totalFileSize > $maxFileSize) {
                ?>
                    <script>
                        window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&tolarge');
                    </script>
                <?php 
            } else {
                $fileName = md5(time() . $_FILES['myfile']) . '.' . $_FILES['myfile']['name'][$i];

                date_default_timezone_set('America/New_York');
                $estTime = date('Y-m-d');

                $sql = "INSERT INTO class_files (name,size,downloads,usersid,datePublished,folderParent) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    ?>
                        <script>
                            window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&err');
                        </script>
                    <?php 
                } else {
                    $zero = 0;

                    mysqli_stmt_bind_param($stmt, "ssssss", $fileName, $fileSize, $zero, $userid, $estTime, $folder_get_contentname);
                    mysqli_stmt_execute($stmt);
                    ?>
                        <META HTTP-EQUIV="Refresh" Content="0; URL='?foldername=<?php echo rawurlencode($folder_get_contentname); ?>'">
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
?>