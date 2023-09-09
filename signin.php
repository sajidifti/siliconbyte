<?php
// Include your database connection file
include('db-connection.php');

// Initialize error message
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare a SELECT query with a placeholder for username
    $sql = "SELECT user_id, username, email, password, role FROM Users WHERE username = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Bind the result
    $stmt->bind_result($user_id, $dbUsername, $dbEmail, $dbPassword, $dbRole);

    // Fetch the result
    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($password, $dbPassword)) {
            // Password is correct, set session variables and redirect to user's profile
            session_start();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $dbUsername;
            $_SESSION["role"] = $dbRole;
            $_SESSION["email"] = $dbEmail;

            // Close the first prepared statement
            $stmt->close();

            // When a user logs in
            $event_type = "signin";
            $event_description = "User with ID " . $user_id . " signed in.";
            $insert_query = "INSERT INTO Analytics (event_type, event_description) VALUES (?, ?)";
            $stmt2 = $conn->prepare($insert_query);
            $stmt2->bind_param("ss", $event_type, $event_description);
            $stmt2->execute();
            $stmt2->close();

            // Similar logic for other events like signup, post creation, etc.

            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect
            $error = "ইউজারনেম অথবা পাসওয়ার্ড সঠিক নয়।";
        }
    } else {
        // User with the provided username does not exist
        $error = "ইউজারনেম অথবা পাসওয়ার্ড সঠিক নয়।";
    }

    // Close the first prepared statement (if not already closed due to successful login)
    if ($stmt) {
        $stmt->close();
    }
}

// Redirect to signin_page.php with the error message as a URL parameter
if (!empty($error)) {
    header("Location: signin_page.php?error=" . urlencode($error));
    exit();
}
?>