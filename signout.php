    <?php
    session_start();

    $_SESSION = array();

    session_destroy();

    $success = "সাইনআউট সফল হয়েছে।";

    // Redirect to signin_page.php with the success message
    header("Location: signin_page.php?success=" . urlencode($success));
    exit();
    ?>