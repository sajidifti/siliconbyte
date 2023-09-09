<?php
session_start();

// Include your database connection file
include 'db-connection.php'; // Replace with the actual path to your database connection file

$user_id = $_SESSION["user_id"];

// When a user logs out
$event_type = "signout";
$event_description = "User with ID " . $user_id . " signed out.";
$insert_query = "INSERT INTO Analytics (event_type, event_description) VALUES (?, ?)";
$stmt = $conn->prepare($insert_query);

if ($stmt === false) {
    // Handle the error if the prepared statement fails
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
} else {
    $stmt->bind_param("ss", $event_type, $event_description);

    if ($stmt->execute()) {
        // Successfully recorded the sign-out event
    } else {
        // Handle the error if the execution fails
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();
}

// Similar logic for other events like signup, post creation, etc.

// Clear and destroy the session
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