<?php
// Include your database connection file
include('db-connection.php');

// Initialize error message
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm-password"];
    $profilePicture = NULL;

    // Regex pattern for username validation
    $usernamePattern = "/^[A-Za-z0-9_]+$/"; // Allow letters, numbers, and underscores
    $passwordPattern = "/^(?=.*\d)(?=.*[A-Za-z])[A-Za-z\d!@#$%^&*()_+]{8,}$/"; // At least 8 characters, including letters and numbers

    // Validate name
    if (!preg_match("/^[A-Za-zঅ-ঐক-য়\s]+$/", $name)) {
        $error = "নামের ফরমেট ঠিক নেই। শুধুমাত্র বর্ণমালা লিখুন।";
    }
    // Validate username
    elseif (!preg_match($usernamePattern, $username)) {
        $error = "ইউজারনেমের ফরমেট ঠিক নেই। শুধুমাত্র বর্ণমালা, সংখ্যা, এবং আন্ডারস্কোর লিখুন।";
    }
    // Validate email using filter_var
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "ইমেইল ঠিকানার ফরমেট ঠিক নেই। সঠিক ইমেইল লিখুন।";
    }
    // Validate password
    elseif (!preg_match($passwordPattern, $password)) {
        $error = "পাসওয়ার্ডের ফরমেট ঠিক নেই। সর্বনিম্ন ৮ টি অক্ষর এবং সংখ্যা লিখুন।";
    }
    // Check if password and confirm password match
    elseif ($password !== $confirm_password) {
        $error = "পাসওয়ার্ডদ্বয় মেলে নি। আবার চেষ্টা করুন।";
    } else {
        // Check if the username already exists in the database
        $checkUsernameQuery = "SELECT username FROM Users WHERE username = ?";
        $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
        $checkUsernameStmt->bind_param("s", $username);
        $checkUsernameStmt->execute();
        $checkUsernameStmt->store_result();

        // Check if the email already exists in the database using FILTER_VALIDATE_EMAIL
        $checkEmailQuery = "SELECT email FROM Users WHERE email = ?";
        $checkEmailStmt = $conn->prepare($checkEmailQuery);
        $checkEmailStmt->bind_param("s", $email);
        $checkEmailStmt->execute();
        $checkEmailStmt->store_result();

        // If a row is fetched, it means the username or email already exists
        if ($checkUsernameStmt->num_rows > 0) {
            $error = "ইউজারনেম আগে ব্যবহৃত হয়েছে। দয়া করে পুনরায় চেষ্টা করুন।";
        } elseif ($checkEmailStmt->num_rows > 0) {
            $error = "ইমেইল ঠিকানা আগে ব্যবহৃত হয়েছে। দয়া করে পুনরায় চেষ্টা করুন।";
        } else {
            // If all validations pass and no duplicate username or email, proceed with registration
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Check if a profile picture is uploaded
            if ($_FILES["profile-picture"]["error"] === 0) {
                $uploadDir = "uploads/profile/";
                $uploadedFileName = $_FILES["profile-picture"]["name"];
                $uploadedFile = $uploadDir . basename($uploadedFileName);

                // Check if a file with the same name already exists
                if (file_exists($uploadedFile)) {
                    // Generate a unique filename by appending a timestamp
                    $timestamp = time();
                    $newFileName = $timestamp . '_' . $uploadedFileName;
                    $uploadedFile = $uploadDir . basename($newFileName);
                }

                // Move the uploaded file to the desired directory
                if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $uploadedFile)) {
                    $profilePicture = $uploadedFile;
                }
            }

            // Insert user data into the Users table
            $sql = "INSERT INTO Users (fullname, username, email, password, role, profile_photo) VALUES (?, ?, ?, ?, 'reader', ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $name, $username, $email, $password, $profilePicture);


            if ($stmt->execute()) {
                // Registration successful, redirect to a success page or login page
                $success = "নিবন্ধন সফল হয়েছে। সাইনইন করুন।";

                // Redirect to signin_page.php with the success message
                header("Location: signin_page.php?success=" . urlencode($success));
                exit();
            } else {
                // Registration failed, handle the error
                $error = $stmt->error;
            }

            // ...
            // Close the database connection
            $stmt->close();
        }

        // Close the check statement for username and email
        $checkUsernameStmt->close();
        $checkEmailStmt->close();
    }
}

// If there is an error, redirect to signup_page.php with the error message
if (!empty($error)) {
    header("Location: signup_page.php?error=" . urlencode($error));
    exit();
}
?>