<?php

include('db-connection.php');
// Handle the contact form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Assuming you have a database connection, you can insert the email into the Contacts table here
    // Replace 'your_db_connection.php' with your actual database connection code
    

    // Perform the database insertion (assuming you have a 'Contacts' table)
    $insertQuery = "INSERT INTO Contacts (email) VALUES (?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        // Email inserted successfully

        // Redirect to index.php with a success message
        header("Location: index.php?success=আপনার যোগাযোগ তথ্যটি সফলভাবে প্রেরণ হয়েছে।");
        exit();
    } else {
        // Handle database insertion error
        header("Location: index.php?error=ডেটাবেসে ত্রুটি ঘটেছে।");
        exit();
    }
} else {
    // If the form is not submitted or 'email' is not set, redirect to the contact form page
    header("Location: index.php");
    exit();
}
?>