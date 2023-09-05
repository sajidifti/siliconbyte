    <?php
    session_start();

    $_SESSION = array();

    session_destroy();

    header("Location: signin_page.php");
    exit();
    ?>