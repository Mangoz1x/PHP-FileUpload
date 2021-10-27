 <?php 
    if (isset($_GET['file_prev'])) {
        $file_prev = rawurlencode($_GET['file_prev']);
        $newFileNameAfterExpload_Full = explode('.', $file_prev, 2)[1];
            
        $filepath = pathinfo('Class/Uploads/' . $userid . '/' . $file_prev);
        $cleanFolderName = rawurlencode($_GET['foldername']);
        ?>  
            <div class="full-frame">
                <div class="align-items-left">
                    <div class="top-file-info-container">
                        <a href="?foldername=<?php echo $cleanFolderName; ?>" class="href_close_screen_prev" id="closebtn">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </a>

                        <p class="file_name"><?php echo htmlentities(rawurldecode($newFileNameAfterExploadUploadsFilePrev)); ?></p>
                    </div>
                    <div class="AlignItemsToCenter">
                        <div class="limit-width-justify">
                            <div class="loader-wrapper">
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
                                        <object data="<?php echo 'class/uploads/' . $userid . '/' . $file_prev; ?>" type="application/pdf" class="max-height-pdf-view">
                                            <div class="centerContent">
                                                <h1 style="color: white; text-align: center;">Cannot Display File Types "Pdf, and Docx".</h1>
                                            </div>
                                        </object>
                                    <?php 
                                } else if (preg_match('/html|php|HTML|PHP|txt|TXT/', $file_prev)) {
                                    ?>
                                        <textarea name="file_contents" class="file_html_show_contents">
                                            <?php 
                                                echo htmlentities(file_get_contents('Class/Uploads/' . $userid . '/' . rawurldecode($file_prev)));
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
                                        <div class="SongFolderMaxContentPreview">
                                            <h2>Looks like we cant display this kind of file.</h2>
                                        </div>
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
