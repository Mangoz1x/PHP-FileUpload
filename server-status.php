<?php
    include_once "header.php";
    include 'Dependencies/PHP_CSS/server-status.php';
    
    error_reporting(0);
?>

<html>
    <body>
        <?php
            $ch = curl_init("40.88.134.219");
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if($httpcode !== 0){
                echo "<div class='status-first'>Website Status: <b style='color: green;'>Online | </b>" . ping("40.88.134.219", 80, 10) . "</div>";
                echo "<div class='status'>Uploading Status: <b style='color: green;'>Online | </b> " . ping("40.88.134.219", 80, 10) . "</div>";
            } else {
                echo "
                    <div class='status-first'>Website Status: <b style='color: red;'>Offline</b></div>
                    <div class='status'>Uploading Status: <b style='color: red;'>Offline</b></div>
                ";
            }

            ################### SERVER PING TIME

            function ping($host, $port, $timeout) { 
                $tB = microtime(true); 
                $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
                if (!$fP) { return "down"; } 
                $tA = microtime(true); 
                return round((($tA - $tB) * 1000), 0)." ms"; 
              }
        ?>
    </body>
</html>




