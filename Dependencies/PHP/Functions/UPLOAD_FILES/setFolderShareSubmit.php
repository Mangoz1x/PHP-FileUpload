<?php
    if(isset($_POST['setFolderShareSubmit'])) {
        $setShareValueF = $_POST['setFolderShare'];
        $fileShareNameValidationF = $_GET['folderValueName'];

        $sql = "UPDATE folders SET publicView=? WHERE folderName=? AND usersUid=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            ?>
                <script>
                    window.location.replace('?err');
                </script>
            <?php 
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $setShareValueF, $fileShareNameValidationF, $userid);
            mysqli_stmt_execute($stmt);

            @apache_setenv('no-gzip', 1);
            @ini_set('zlib.output_compression', 0);
            @ini_set('output_buffering', 'Off');
            @ini_set('implicit_flush', 1);
                                    
            ob_implicit_flush(1);
            for ($i = 0, $level = ob_get_level(); $i < $level; $i++) ob_end_flush();
            ?>
                <div class="center_content_x_z_y uploading-status">
                    <div id="loading">
                        <h2>Updating...</h2>
                    </div>
                </div>
            <?php
                                    
            echo str_repeat(" ", 1024), "\n";
                                    
            ob_start();
            sleep(1); 
            echo "Uploaded";

            ob_flush();
            flush();

            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . '?' . '">';
        }
        mysqli_close($conn);
    } 
?>