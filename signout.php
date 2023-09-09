<?php
session_start();

$user_id = $_SESSION["user_id"];

// When a user logs in
$event_type = "signout";
$event_description = "User with ID " . $user_id . " signed out.";
$insert_query = "INSERT INTO Analytics (event_type, event_description) VALUES (?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("ss", $event_type, $event_description);
$stmt->execute();
$stmt->close();

// Similar logic for other events like signup, post creation, etc.


$_SESSION = array();

session_destroy();

if (!empty($_GET['success'])) {
    $success = urldecode($_GET['success']);
} else {
    $success = "সাইনআউট সফল হয়েছে।";
}


// Redirect to signin_page.php with the success message
header("Location: signin_page.php?success=" . urlencode($success));
exit();
?>