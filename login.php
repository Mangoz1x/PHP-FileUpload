<?php
    include_once 'header.php';
    include 'Dependencies/PHP_CSS/login.php';

    if (isset($_SESSION['useruid'])) {
        ?>
            <script> 
                window.location.href = 'upload.php';
            </script>
        <?php 
    }
?>

<html>
    <head>
        <title>Mangoz1x Login | Free And Fast Uploading</title>
    </head>
<body>
    <div class="main-login">
        <div class="LoginCss">
            <div class="LoginCssCenterAll">
                <div class="LoginCssCenter">
                    <h2>Login</h2>
                </div>
                <div class="LoginCssCenter">
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "<h3 class='msg-error'>Fill in all fields</h3>";
                            }
                            else if ($_GET["error"] == "wronglogin") {
                                echo "<h3 class='msg-error'>Invalid username or password!</h3>";
                            }
                        }
                    ?>
                </div>
                <div class="LoginCssCenter">
                    <form action="includes/login.inc.php" method="post">
                        <input type="text" name="uid" class="input-field" placeholder="Username/Email..."><br>
                        <input type="password" name="pwd" class="input-field margin" placeholder="Password..."><br>
                        <button type="submit" class="submit-btn margin" name="submit">Login</button>
                    </form>
                </div>
                <!--<a href="resetPwd.php" style="color: lightgray;">Forgot Password?</a>-->
            </div>
        </div>
    </div>
</body>
</html>
