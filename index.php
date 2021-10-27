<?php
    error_reporting(0);
    include_once 'header.php';
    include_once 'includes/dbh.inc.php';
    include_once 'includes/Logging/log-home.php';
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Dependencies/CSS/index.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    </head>
<body>
    <div class="main">
        <div class="Section">
            <div class="centerContent">
                <div class="portfolioHeading" style="margin-top: -80px;">
                    <h1>Mangoz1x</h1>
                </div>
                <div class="catchPara">
                    <p><strong>Free, Secure And Fast File Uploading</strong></p>
                </div> 
                <div class="tryItFree">
                    <a href="signup.php">Try It Free</a>
                </div>
            </div>
        </div>
        
        <!--FOOTER-->
            <div class="footer" onclick="hideUserDropDown()">
                <div class="alignNoticeToRight">
                    <p class="version_number_alrt">This website is in beta version and has flaws</p>
                </div>
                <div class="center_all_content_footer">
                    <p class="AddCustomTextColor">
                        <div>
                            <a href="https://www.twitch.tv/mangoz1x" class="AddCustomTextColor" title="twitch">Twitch</a>
                            <a href="https://www.youtube.com/channel/UC6QuDrkms9y2aaorhiAOaEA" class="AddCustomTextColor" style="margin-left: 20px;" title="youtube">Youtube</a>
                        </div>
                        <div class="AlignBottomContainer">
                            <div class="AlignItemsBottomFromMain">
                                <p class="AddCustomTextColor">Copyright &#169; 2021 Mangoz1x. All Rights Reserved</p>
                                <p class="version_number_responsive_mobile" style="min-width: 140px;">Beta Version 1.1.3</p>
                            </div>
                        </div>
                    </p>
                </div>
                <div class="alignContentToBottom">
                    <p class="version_number" style="min-width: 140px;">Beta Version 1.1.3</p>
                </div>
            </div>
        <!--FOOTER-->
    </div>
</body>
</html>
    
