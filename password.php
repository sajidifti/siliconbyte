<?php
// Include your database connection code here
include('db-connection.php');

session_start();

$dbUsername = $_SESSION['username']; // Assuming you have the username in the session

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        $error = "নতুন পাসওয়ার্ড এবং কনফার্ম পাসওয়ার্ড মেলে নি।";

        header("Location: password_page.php?success=" . urlencode($error));
        exit();
    }

    // Fetch the current hashed password from the database
    $query = "SELECT PASSWORD FROM Users WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $dbUsername);

    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($hashedPassword);
            $stmt->fetch();

            // Verify the entered current password against the stored hashed password
            if (password_verify($oldPassword, $hashedPassword)) {
                // Hash the new password
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $updateQuery = "UPDATE Users SET PASSWORD=? WHERE username=?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("ss", $newHashedPassword, $dbUsername);

                if ($updateStmt->execute()) {
                    // Password updated successfully
                    $success = "পাসওয়ার্ড পরিবর্তন সফল হয়েছে। সাইনইন করুন।";

                    header("Location: signout.php?success=" . urlencode($success));
                } else {
                    $error = "পাসওয়ার্ড পরিবর্তন সফল হয়নি। আবার চেষ্টা করুন।\n" . $updateStmt->error;

                    header("Location: pasword_page.php?success=" . urlencode($error));
                }
            } else {
                $error = "বর্তমান পাসওয়ার্ড সঠিক নয়।";

                header("Location: password_page.php?success=" . urlencode($error));
            }
        } else {
            $error = "ইউজার পাওয়া যায় নি।";

            header("Location: password_page.php?success=" . urlencode($error));
        }
    } else {
        $error = "ইউজার তথ্য পেতে ব্যর্থ।" . $stmt->error;
        ;

        header("Location: password_page.php?success=" . urlencode($error));
    }
}
?>