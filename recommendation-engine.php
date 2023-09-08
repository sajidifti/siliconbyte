<?php
require_once('db-connection.php'); // Include your database connection script

session_start();

// Function to calculate recommendation scores for articles
function calculateRecommendationScore($user_id, $article_id)
{
    global $conn;

    $baseScore = 5; // A base score for all articles
    $userPreferences = getUserPreferences($user_id); // Get user's category and tag preferences
    $articleCategories = getArticleCategories($article_id); // Get article categories
    $articleTags = getArticleTags($article_id); // Get article tags

    // Calculate score based on category match
    $categoryMatchScore = calculateCategoryMatchScore($userPreferences['categories'], $articleCategories);

    // Calculate score based on tag match
    $tagMatchScore = calculateTagMatchScore($userPreferences['tags'], $articleTags);

    // Combine scores (you can adjust weights here)
    $recommendationScore = $baseScore + $categoryMatchScore + $tagMatchScore;

    return $recommendationScore;
}

// Function to get user's category and tag preferences
function getUserPreferences($user_id)
{
    global $conn;

    // Initialize arrays to store user preferences for categories and tags
    $userCategoryPreferences = [];
    $userTagPreferences = [];

    // Query the User_Category_Read_Count table to retrieve category preferences
    $category_query = "SELECT category, read_count FROM User_Category_Read_Count WHERE user_id = $user_id";
    $category_result = $conn->query($category_query);

    if ($category_result) {
        while ($row = $category_result->fetch_assoc()) {
            $category = $row['category'];
            $read_count = $row['read_count'];
            // Store category preferences in the array
            $userCategoryPreferences[$category] = $read_count;
        }
    }

    // Query the User_Tag_Read_Count table to retrieve tag preferences
    $tag_query = "SELECT t.tag_id, t.tag_name, urc.read_count
                  FROM User_Tag_Read_Count urc
                  INNER JOIN Tags t ON urc.tag_id = t.tag_id
                  WHERE urc.user_id = $user_id";
    $tag_result = $conn->query($tag_query);

    if ($tag_result) {
        while ($row = $tag_result->fetch_assoc()) {
            $tag_id = $row['tag_id'];
            $tag_name = $row['tag_name'];
            $read_count = $row['read_count'];
            // Store tag preferences in the array
            $userTagPreferences[$tag_id] = [
                'tag_name' => $tag_name,
                'read_count' => $read_count,
            ];
        }
    }

    return [
        'categories' => $userCategoryPreferences,
        'tags' => $userTagPreferences,
    ];
}


// Function to get article categories
function getArticleCategories($article_id)
{
    global $conn;

    // Initialize an array to store the article categories
    $articleCategories = [];

    // Query the Articles table to retrieve the category of the article
    $category_query = "SELECT category FROM Articles WHERE article_id = $article_id";

    $category_result = $conn->query($category_query);

    if ($category_result && $category_result->num_rows === 1) {
        $row = $category_result->fetch_assoc();
        $articleCategories[] = $row['category'];
    }

    return $articleCategories;
}


// Function to get article tags
function getArticleTags($article_id)
{
    global $conn;

    // Initialize an array to store the article tags
    $articleTags = [];

    // Query the Article_Tags table to retrieve tags associated with the article
    $tag_query = "SELECT t.tag_name FROM Tags t
                  INNER JOIN Article_Tags at ON t.tag_id = at.tag_id
                  WHERE at.article_id = $article_id";

    $tag_result = $conn->query($tag_query);

    if ($tag_result) {
        while ($row = $tag_result->fetch_assoc()) {
            $articleTags[] = $row['tag_name'];
        }
    }

    return $articleTags;
}


// Function to calculate category match score
function calculateCategoryMatchScore($userCategories, $articleCategories)
{
    // Initialize a variable to store the score
    $matchScore = 0;

    // Calculate the intersection of user categories and article categories
    $commonCategories = array_intersect($userCategories, $articleCategories);

    // You can adjust the scoring logic based on your requirements
    // For example, you can give more weight to a larger number of common categories
    // Here, we'll simply count the common categories
    $matchScore = count($commonCategories);

    return $matchScore;
}


// Function to calculate tag match score
function calculateTagMatchScore($userTags, $articleTags)
{
    // Initialize a variable to store the score
    $matchScore = 0;

    // Calculate the intersection of user tags and article tags
    $commonTags = array_intersect($userTags, array_keys($articleTags));

    // You can adjust the scoring logic based on your requirements
    // For example, you can give more weight to a larger number of common tags
    // Here, we'll simply count the common tags and sum their read counts
    foreach ($commonTags as $tag_id) {
        $matchScore += $articleTags[$tag_id]['read_count'];
    }

    return $matchScore;
}



// Function to get recommended articles for a user
function getRecommendedArticles($user_id)
{
    global $conn;

    // Calculate recommendation scores for articles
    $recommendations = [];

    // Replace this with your code to find similar users and calculate scores
    // You'll need to implement user similarity calculations here
    // For simplicity, we'll generate random recommendations
    $article_query = "SELECT article_id, title FROM Articles ORDER BY RAND() LIMIT 10";
    $article_result = $conn->query($article_query);

    while ($row = $article_result->fetch_assoc()) {
        $article_id = $row['article_id'];
        $title = $row['title'];

        // Calculate a recommendation score (for illustration, using a random score)
        $recommendation_score = calculateRecommendationScore($user_id, $article_id);

        // Store the article and its recommendation score
        $recommendations[$article_id] = [
            'title' => $title,
            'score' => $recommendation_score,
        ];
    }

    // Sort articles by recommendation score in descending order
    arsort($recommendations);

    return $recommendations;
}

// Function to authenticate a user (replace with your authentication logic)
function authenticateUser($username, $password)
{
    global $conn;

    // Implement your user authentication logic here
    // Example: Check if the username and password match a user in the database
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $query = "SELECT user_id FROM Users WHERE username = '$username' AND PASSWORD = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        return $row['user_id'];
    } else {
        return false; // Authentication failed
    }
}

// Main script
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get user credentials from request parameters
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Authenticate the user
    $user_id = authenticateUser($username, $password);

    if ($user_id !== false) {
        // Get recommended articles for the authenticated user
        $recommended_articles = getRecommendedArticles($user_id);

        // Return the recommended articles in JSON format
        header('Content-Type: application/json');
        echo json_encode($recommended_articles);
    } else {
        http_response_code(401); // Unauthorized
        echo "Authentication failed.";
    }
} else {
    http_response_code(405); // Method Not Allowed
}
?>