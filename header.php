<?php 
    session_start();
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta property="og:url" content="https://www.mangoz1x.com/Site/Upl/" />
  <meta property="og:title" content="Mangoz1x - Upload Files Faster" />
  <meta property="og:description" content="Upload large files extremely fast with Mangoz1x. Easy to use UI with secure file sending and uploading. Use our built in file sending to transfer files to your friends or families accounts fast, and easily! Try it free now." />
  <meta property="og:image" content="https://www.mangoz1x.com/Site/Upl/IMG/Web/prev.png" />

  <meta name="description" content="Upload large files extremely fast with Mangoz1x. Easy to use UI with secure file sending and uploading. Use our built in file sending to transfer files to your friends or families accounts fast, and easily! Try it free now.">
  <meta name="keywords" content="HTML, CSS, PHP, Files, File Uploading, Fast File Uploading, Mangoz1x, Mangoz1x file uploading, files">
  <meta name="author" content="Ryan">
  <title>Mangoz1x - Upload Files Faster</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="image_src" href="https://www.mangoz1x.com/Site/Upl/IMG/Web/prev.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" type="image/jpg" href="favico.png"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="Dependencies/CSS/headerProfile.css">
</head>
<body>
    <nav>
    <div class="topnav" id="myTopnav">
	        <?php 
            if (isset($_SESSION["useruid"])) {
              include_once "includes/dbh.inc.php";
              $customHeadUser = $_SESSION["useruid"];

              $sql = "SELECT * FROM users WHERE userId=?";
              $stmt = mysqli_stmt_init($conn);

              if (!mysqli_stmt_prepare($stmt, $sql)) {
                die();
              } else {
                  mysqli_stmt_bind_param($stmt, "s", $customHeadUser);
                  mysqli_stmt_execute($stmt);
              }
              $result = mysqli_stmt_get_result($stmt);
              $row = $result->fetch_assoc();

              $words = strtoupper($row["usersName"]);

              $acronym = mb_substr($words, 0, 1, "UTF-8");

              echo "<a id='userProfileDropDown' class='responsiveDisplayNoneMenu allDropDownPFPItems' onclick='userDropDown()'>
                <span class='allDropDownPFPItems'>$acronym</span>
              </a>";
            }
        ?>
        <a href="/index.php">Home</a>
        <?php # THE PART WHERE IT CHANGES IF USER IS LOGGED IN
            if (isset($_SESSION["useruid"])) {
                echo "<a href='upload.php' id='nav-links'>Upload</a>";
                echo "<a href='includes/logout.inc.php'>Logout</a>"; #LOGOUT PAGE
            } else {
                echo "<a href='signup.php' id='nav-links'>Sign Up</a>";
                echo "<a href='login.php' id='nav-links'>Login</a>";
            }
        ?>
	      <a href="terms.php">Privacy Policy</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars" style="font-size:17px;"></i>
        </a>
    </div>
    </nav>
    <div id="userOnclickHeaderDropDown" class="responsiveDisplayNoneMenu mainDropDownPfpContent allDropDownPFPItems" style="display: none;">
      	<a class="userSettingsFromDropDown">
        	Settings
      	</a>
    </div>
    <script src="./Dependencies/JS/HEADER/headerLogicUser.js"></script>
</body>
</html>

<script>
  function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
    } else {
      x.className = "topnav";
    }
  }
</script>

<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #2c2b30;
}

.topnav a {
  float: right;
  display: block;
  color: #d6d6d6;
  text-align: center;
  padding: 30px 35px;
  text-decoration: none;
  font-size: 20px;
}

.topnav a:hover {
    color: #c2c2c2;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}

.topnav .icon {
  display: none;
  padding: 31.5px 35px;
}

@media screen and (max-width: 700px) {
  .topnav a:not(:first-child) {display: none;}
  .topnav a.icon {
    float: right;
    display: block;
  }

  .topnav a {
      float:left;
  }
}

@media screen and (max-width: 700px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }

  .responsiveDisplayNoneMenu {
    display: none !important;
  }
}
</style>