<?php
    $sql = "SELECT * FROM users WHERE userId=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        ?>
            <script>
                window.location.replace('?err');
            </script>
        <?php 
    } else {
        mysqli_stmt_bind_param($stmt, "s", $useruid);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $row = $result->fetch_assoc();
    $personalEmail = $row['usersEmail'];
    $getCustomPersonalUid = $row['usersUid'];

    $sql = "SELECT * FROM inbox WHERE sentToUser=? OR sentToUser=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        ?>
            <script>
                window.location.replace('?err');
            </script>
        <?php 
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $personalEmail, $getCustomPersonalUid);
        mysqli_stmt_execute($stmt);
    }

    $result = mysqli_stmt_get_result($stmt);
    $inboxCount = mysqli_num_rows($result); 
?>