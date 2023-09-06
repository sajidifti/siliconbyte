<?php
// Include your database connection code here
include('db-connection.php');

// Function to validate username with regex
function isValidUsername($username)
{
    // Define a regex pattern for a valid username
    $pattern = '/^[a-zA-Z0-9_]{3,20}$/'; // Allow letters, numbers, and underscores; 3-20 characters
    return preg_match($pattern, $username);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $fullname = $_POST['name'];
    $newUsername = $_POST['username'];
    $email = $_POST['email'];
    $profilePicture = $_FILES['profile-picture'];

    // Check if username and email have been changed
    $query = "SELECT username, email, profile_photo FROM Users WHERE user_id = ?"; // Assuming you have a user_id available
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $user_id = 1; // Replace with the actual user's ID

    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($oldUsername, $oldEmail, $oldProfilePhoto);

    if ($stmt->fetch()) {
        if ($newUsername !== $oldUsername) {
            // Check if the new username is available
            $query = "SELECT username FROM Users WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $newUsername);

            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "Username is already taken.";
                exit();
            }
        }

        if ($email !== $oldEmail) {
            // Check if the new email is available
            $query = "SELECT email FROM Users WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $email);

            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "Email is already registered.";
                exit();
            }
        }
    }

    // Check if a profile picture was selected
    if ($profilePicture['error'] == 0) {
        // Handle profile picture upload
        $uploadDirectory = 'uploads/'; // Specify your upload directory
        $originalFileName = $profilePicture['name'];
        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $newFileName = $newUsername . '_' . time() . '.' . $fileExtension; // Rename the file

        $targetPath = $uploadDirectory . $newFileName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($profilePicture['tmp_name'], $targetPath)) {
            // File uploaded successfully, update the user's profile photo
            // Update the user's profile photo in the database
            $query = "UPDATE Users SET fullname=?, email=?, profile_photo=? WHERE user_id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $fullname, $email, $newFileName, $user_id);

            if ($stmt->execute()) {
                // User information updated successfully
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
        $query = "UPDATE Users SET fullname=?, email=? WHERE user_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $fullname, $email, $user_id);

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