<?php
require_once('db-connection.php'); // Include your database connection script
// require_once('recommendation-engine.php');

// Start the session (if not already started)
session_start();

// Check if the user is authenticated
$user_id = $_SESSION['user_id']; // Make sure the user is properly authenticated

if ($user_id !== false) {
    // Call the getRecommendedArticles function to store recommended article IDs in session
    // getRecommendedArticles($user_id);
    // $recommended_article_ids = $_SESSION['recommended_articles'];
    require_once('recommend.php');
    $recommended_article_ids = $_SESSION['article_id'];

    // Loop through the recommended article IDs and fetch data from the database
    foreach ($recommended_article_ids as $article_id) {
        // Query the database to fetch data for the article using $article_id
        $article_query = "SELECT * FROM Articles WHERE article_id = $article_id";
        $article_result = $conn->query($article_query);

        if ($article_result && $article_result->num_rows === 1) {
            // Fetch and display the article data (adjust as needed)
            $row = $article_result->fetch_assoc();
            echo 'Article ID: ' . $row['article_id'] . '<br>';
            echo 'Article Title: ' . $row['title'] . '<br>';
            echo 'Article Category: ' . $row['category'] . '<br><br><br>';
            // echo 'Article Content: ' . $row['content'] . '<br>';
            // Add more fields as needed
        }
    }
} else {
    http_response_code(401); // Unauthorized
    echo "Authentication failed.";
}
?>