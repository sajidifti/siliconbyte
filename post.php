<?php
// Include the database connection file
include 'db-connection.php';

// Start the session
session_start();

// Check if the user is logged in and has a valid session
if (isset($_SESSION['user_id'])) {
    // Get the user_id from the session
    $user_id = $_SESSION['user_id'];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $title = $_POST['title'];
        $summary = $_POST['summary'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        // Retrieve each of the 5 tag values as separate variables
        $tag1 = $_POST['tag1'];
        $tag2 = $_POST['tag2'];
        $tag3 = $_POST['tag3'];
        $tag4 = $_POST['tag4'];
        $tag5 = $_POST['tag5'];

        // File upload handling (photo)
        $targetDir = "uploads/article/"; // Specify the directory where you want to save uploaded photos
        $originalFileName = basename($_FILES["photo"]["name"]);
        $targetFile = $targetDir . $originalFileName;

        // Check if the file already exists
        $counter = 1;
        while (file_exists($targetFile)) {
            $filenameParts = pathinfo($originalFileName);
            $newFileName = $filenameParts['filename'] . '_' . $counter . '.' . $filenameParts['extension'];
            $targetFile = $targetDir . $newFileName;
            $counter++;
        }

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // File uploaded successfully
            // Insert data into the Articles table
            $insertArticleSQL = "INSERT INTO Articles (title, summary, content, article_photo, category, user_id) VALUES (?, ?, ?, ?, ?, ?)";
            if ($stmt = $conn->prepare($insertArticleSQL)) {
                $stmt->bind_param("sssssi", $title, $summary, $content, $targetFile, $category, $user_id);
                if ($stmt->execute()) {
                    $article_id = $stmt->insert_id;

                    // Insert tags into the Article_Tags table (many-to-many relationship)
                    $insertTagSQL = "INSERT INTO Article_Tags (article_id, tag_id) VALUES (?, ?)";
                    $stmtTag = $conn->prepare($insertTagSQL);

                    // Insert the 5 tags individually
                    $stmtTag->bind_param("ii", $article_id, $tag1);
                    $stmtTag->execute();

                    $stmtTag->bind_param("ii", $article_id, $tag2);
                    $stmtTag->execute();

                    $stmtTag->bind_param("ii", $article_id, $tag3);
                    $stmtTag->execute();

                    $stmtTag->bind_param("ii", $article_id, $tag4);
                    $stmtTag->execute();

                    $stmtTag->bind_param("ii", $article_id, $tag5);
                    $stmtTag->execute();

                    // Close prepared statements
                    $stmtTag->close();
                    $stmt->close();

                    // Redirect to a success page or do further processing
                    $success = "লেখাটি প্রকাশিত হয়েছে।";
                    header("Location: post_page.php?success=" . urlencode($success));
                    exit();
                } else {
                    // Handle article insertion error
                    $error = "খবর সংরক্ষণের সময় ডেটাবেসে ত্রুটি হয়েছে: " . $stmt->error;
                }
            } else {
                // Handle article insertion preparation error
                $error = "স্টেটমেন্ট প্রস্তুতের সময় ডেটাবেসে ত্রুটি হয়েছে।";
            }
        } else {
            // Handle file upload error
            $error = "ছবি আপলোডের সময় ত্রুটি হয়েছে।";
        }

        // Close database connection
        $conn->close();

        // Redirect to post_page.php with the error message
        header("Location: post_page.php?error=" . urlencode($error));
        exit();
    } else {
        // If the form is not submitted, redirect to the form page or handle it accordingly.
        header("Location: post_page.php");
        exit();
    }
} else {
    // If the user is not logged in, you can redirect them to a login page or handle it accordingly.
    $error = "Please sign in to view this page.";
    header("Location: signin_page.php?error=" . urlencode($error));
    exit();
}
?>