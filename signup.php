<?php
    include_once 'header.php';
    include 'Dependencies/PHP_CSS/signup.php';

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
        <title>Mangoz1x Signup | Free And Fast File Uploading</title>
    </head>
<body>
<div class="main-menu">
    <div class="LoginCss">
        <div class="LoginCssCenterAll">
            <div class="LoginCssCenter">
                <h2>Sign Up</h2>
            </div>
            <div class="LoginCssCenter">  
                <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<h3 class='error-txt'>Fill in all fields</h3>";
                        }
                        else if ($_GET["error"] == "invaliduid") {
                            echo "<h3 class='error-txt'>Invalid username!</h3>";
                        }
                        else if ($_GET["error"] == "invalidemail") {
                            echo "<h3 class='error-txt'>Invalid email!</h3>";
                        }
                        else if ($_GET["error"] == "pwdmatchfalse") {
                            echo "<h3 class='error-txt'>Passwords dont match!</h3>";
                        }
                        else if ($_GET["error"] == "stmtfailed") {
                            echo "<h3 class='error-txt'>Something went wrong please try again!</h3>";
                        }
                        else if ($_GET["error"] == "usernametaken") {
                            echo "<h3 class='error-txt'>Username already taken!</h3>";
                        }
                        else if ($_GET["error"] == "none") {
                            echo "<h3 class='correct-txt'>You have signed up!</h3>";
                        }
                    }
                ?> 
            </div>
            <div class="LoginCssCenter">  
                <form action="includes/signup.inc.php" method="post">
                    <input type="text" name="name" placeholder="Full name..." class="input-text"><br>
                    <input type="text" name="email" placeholder="Email..." class="margin-top input-text"><br>
                    <input type="text" name="uid" placeholder="Username..." class="margin-top input-text"><br>
                    <input type="password" name="pwd" placeholder="Password..." class="margin-top input-text"><br>
                    <input type="password" name="pwdrepeat" placeholder="Repeat password..." class="margin-top input-text"><br>
                    <button type="submit" name="submit" class="submit-btn">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

