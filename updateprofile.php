<?php
// Include your database connection code here
include('db-connection.php');

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display a message
    $error = "পাতাটি দেখতে আগে সাইনইন করুন।";
    header("Location: signin_page.php?error=" . urlencode($error));
    exit();
}

$dbUsername = $_SESSION['username'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $fullname = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $profilePicture = $_FILES['profile-picture'];

    // Check if a profile picture was selected
    if ($profilePicture['error'] == 0) {
        // Handle profile picture upload
        $uploadDirectory = 'uploads/profile/'; // Specify your upload directory
        $originalFileName = $profilePicture['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $newFileName = $username . '_' . time() . '.' . $fileExtension; // Rename the file

        $targetPath = $uploadDirectory . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($profilePicture['tmp_name'], $targetPath)) {
            // File uploaded successfully, update the user's profile photo
            // Update the user's profile photo in the database
            $profilePhotoPath = $uploadDirectory . $newFileName; // Concatenate path with file name

            $query = "UPDATE Users SET fullname=?, email=?, profile_photo=? WHERE username=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssss", $fullname, $email, $profilePhotoPath, $dbUsername);

            if ($stmt->execute()) {
                // User information updated successfully

                // When a user logs in
                $user_id = $_SESSION['user_id'];
                $event_type = "edit profile";
                $event_description = "User with ID " . $user_id . " edited profile.";
                $insert_query = "INSERT INTO Analytics (event_type, event_description) VALUES (?, ?)";
                $stmt2 = $conn->prepare($insert_query);
                $stmt2->bind_param("ss", $event_type, $event_description);
                $stmt2->execute();
                $stmt2->close();
                // Similar logic for other events like signup, post creation, etc.

                header("Location: profile.php"); // Redirect to the user's profile page
                exit();
            } else {
                echo "Error updating user information: " . $stmt->error;
            }
        } else {
            echo "Error uploading profile picture.";
        }

    } else {
        // No profile picture was selected, update other user information
        $query = "UPDATE Users SET fullname=?, email=? WHERE username=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $fullname, $email, $username);
        // When a user logs in
        $user_id = $_SESSION['user_id'];
        $event_type = "edit profile";
        $event_description = "User with ID " . $user_id . " edited profile.";
        $insert_query = "INSERT INTO Analytics (event_type, event_description) VALUES (?, ?)";
        $stmt2 = $conn->prepare($insert_query);
        $stmt2->bind_param("ss", $event_type, $event_description);
        $stmt2->execute();
        $stmt2->close();
        if ($stmt->execute()) {
            // User information updated successfully
            header("Location: profile.php"); // Redirect to the user's profile page
            exit();
        } else {
            echo "Error updating user information: " . $stmt->error;
        }
    }
}
?>