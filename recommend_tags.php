<?php
// Start the session
session_start();

// Include the database connection file
include 'db-connection.php';

// Assume you have the user's ID in a session variable
$user_id = $_SESSION['user_id'];

// Query recommended articles based on user's tag preferences
$articles_query = "
    SELECT A.article_id, A.title, A.category, T.tag_name
    FROM Articles A
    INNER JOIN Article_Tags AT ON A.article_id = AT.article_id
    INNER JOIN Tags T ON AT.tag_id = T.tag_id
    INNER JOIN User_Tag_Read_Count U ON AT.tag_id = U.tag_id
    WHERE U.user_id = ?
    ORDER BY U.read_count DESC, RAND() /* To randomize within the same read_count */
    LIMIT 8
";

if ($stmt = $conn->prepare($articles_query)) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $recommended_articles_tags = [];

    while ($row = $result->fetch_assoc()) {
        $recommended_articles_tags[] = $row;
    }

    // Store the recommended articles based on tags in a session variable
    $_SESSION['recommended_articles_tags'] = $recommended_articles_tags;

    // Close the prepared statement
    $stmt->close();
} else {
    // Handle database error here
    die("Error: " . $conn->error);
}

// Close the database connection (if not handled in db-connection.php)
$conn->close();
?>