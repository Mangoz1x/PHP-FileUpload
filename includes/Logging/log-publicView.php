<?php 
    require_once(__DIR__."../../dbh.inc.php");
    require_once(__DIR__."../../../header.php");

    function getBrowser() { 
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
      
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }
      
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif(preg_match('/Firefox/i',$u_agent)){
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif(preg_match('/OPR/i',$u_agent)){
            $bname = 'Opera';
            $ub = "Opera";
        } elseif(preg_match('/Chrome/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif(preg_match('/Safari/i',$u_agent) && !preg_match('/Edge/i',$u_agent)){
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif(preg_match('/Netscape/i',$u_agent)){
            $bname = 'Netscape';
            $ub = "Netscape";
        } elseif(preg_match('/Edge/i',$u_agent)){
            $bname = 'Edge';
            $ub = "Edge";
        } elseif(preg_match('/Trident/i',$u_agent)){
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
      
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
          // 
        }

        $i = count($matches['browser']);
        if ($i != 1) {
             if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }else {
                $version= $matches['version'][1];
            }
        } else {
            $version= $matches['version'][0];
        }
      
        if ($version==null || $version=="") {$version="?";}
      
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    } 
      
    $ua=getBrowser();

    $date = new DateTime("now", new DateTimeZone('America/New_York') );
    $formatDate = $date->format('Y-m-d h:i:s');

    $ip = $_SERVER['REMOTE_ADDR'];
    $browserName = $ua['name'];
    $broswerVersion = $ua['version'];
    $userPlatform = $ua['platform'];
    $userAgent = $ua['userAgent'];
    $visitedPage = "publicView_php";
    if (isset($_SESSION["useruid"])) {
        $userLoginId = $_SESSION["useruid"];
    } else {
        $userLoginId = "Not Logged In";
    }

    //$yourbrowser= "Name: " . $ua['name'] . "Version" . $ua['version'] . " platform" .$ua['platform'] . " user agent" . $ua['userAgent'];
    //echo $yourbrowser;

    $sql = "INSERT INTO client_info (ip,date_time,browser_name,browser_version,request_platform,user_agent,visited_page,user_login_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        //
    } else {
        mysqli_stmt_bind_param($stmt, "ssssssss", $ip, $formatDate, $browserName, $broswerVersion, $userPlatform, $userAgent, $visitedPage, $userLoginId);
        mysqli_stmt_execute($stmt);
    }
?>