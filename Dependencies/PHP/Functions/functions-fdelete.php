<?php 
    if (isset($_GET['fdelete'])) {
        $id = $_GET['fdelete'];
        $userid = $_SESSION["useruid"];
        
        $conn = mysqli_connect("localhost", "root", "", "mangoz1x");
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM class_files WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            ?>
                <script>
                    window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&err');
                </script>
            <?php 
        } else {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if (!$row = mysqli_fetch_assoc($result)) {
                ?>
                    <script>
                        window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&err');
                    </script>
                <?php 
            } else {  
                ?>
                    <META HTTP-EQUIV="Refresh" Content="0; URL='?foldername=<?php echo rawurlencode($folder_get_contentname); ?>'">
                <?php 
            }
        }
        
            
        //

        $sql = "DELETE FROM class_files WHERE usersid=? AND id=?";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            ?>
                <script>
                    window.location.replace('?foldername=<?php echo rawurlencode($folder_get_contentname); ?>&err');
                </script>
            <?php 
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $userid, $id);
            mysqli_stmt_execute($stmt);

            unlink('class/uploads/' . $userid . '/' . rawurlencode($row['name']));
            ?>
                <META HTTP-EQUIV="Refresh" Content="0; URL='?foldername=<?php echo rawurlencode($folder_get_contentname); ?>'">
            <?php 

            @apache_setenv('no-gzip', 1);
            @ini_set('zlib.output_compression', 0);
            @ini_set('output_buffering', 'Off');
            @ini_set('implicit_flush', 1);
                                
            ob_implicit_flush(1);
            ob_end_flush();
                ?>
                    <div class="center_content_x_z_y uploading-status"><div id="loading"><h2>Deleting...</h2></div></div>
                <?php
                                
            echo str_repeat(" ", 1024), "\n";
                                
            ob_start();
            sleep(1); 
            echo "";

            ob_flush();
            flush();
        }
    }
?>