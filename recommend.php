<?php
// Start the session
// session_start();

// Include the database connection file
include 'db-connection.php';

// Assume you have the user's ID in a session variable
$user_id = $_SESSION['user_id'];

// Query recommended articles based on user's reading preferences
$articles_query = "
    SELECT A.article_id, A.title, A.category
    FROM Articles A
    INNER JOIN User_Category_Read_Count U ON A.category = U.category
    WHERE U.user_id = ?
    ORDER BY U.read_count DESC, RAND() /* To randomize within the same read_count */
    LIMIT 12
";

if ($stmt = $conn->prepare($articles_query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $recommended_articles = [];

    while ($row = $result->fetch_assoc()) {
        $recommended_articles[] = $row;
    }

    // Store the recommended article IDs in a session variable
    $_SESSION['recommended_articles'] = $recommended_articles;

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle database error here
    die("Error: " . $conn->error);
}

// Close the database connection (if not handled in db-connection.php)
$conn->close();
?>