<?php
require_once('db-connection.php'); // Include your database connection script

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

    // Loop through user tags and check if they exist in article tags
    foreach ($userTags as $userTag => $userTagData) {
        if (isset($articleTags[$userTag])) {
            // If the user tag exists in the article tags, add its read count to the score
            $matchScore += $userTagData['read_count'];
        }
    }

    return $matchScore;
}




// Function to get recommended articles for a user

function getRecommendedArticles($user_id)
{
    global $conn;

    // Get user's category and tag preferences with read counts
    $userPreferences = getUserPreferences($user_id);

    // Initialize an array to store the recommended article IDs
    $recommended_article_ids = [];

    // Iterate through user preferences for categories
    foreach ($userPreferences['categories'] as $category => $read_count) {
        // Query to retrieve articles in the user's preferred category
        $category_query = "SELECT article_id FROM Articles WHERE category = '$category' ORDER BY views DESC LIMIT 5";

        $category_result = $conn->query($category_query);

        if ($category_result) {
            while ($row = $category_result->fetch_assoc()) {
                $article_id = $row['article_id'];

                // Check if the article is not already recommended and add it to the recommendations
                if (!in_array($article_id, $recommended_article_ids)) {
                    $recommended_article_ids[] = $article_id;
                }
            }
        }
    }

    // Iterate through user preferences for tags
    foreach ($userPreferences['tags'] as $tag_id => $tagData) {
        // Query to retrieve articles associated with the user's preferred tag
        $tag_query = "SELECT article_id FROM Article_Tags WHERE tag_id = $tag_id ORDER BY RAND() LIMIT 5";

        $tag_result = $conn->query($tag_query);

        if ($tag_result) {
            while ($row = $tag_result->fetch_assoc()) {
                $article_id = $row['article_id'];

                // Check if the article is not already recommended and add it to the recommendations
                if (!in_array($article_id, $recommended_article_ids)) {
                    $recommended_article_ids[] = $article_id;
                }
            }
        }
    }

    // Limit the number of recommendations to 10 (you can adjust this number)
    $recommended_article_ids = array_slice($recommended_article_ids, 0, 10);

    // Store the recommended article IDs in a SESSION variable
    $_SESSION['recommended_articles'] = $recommended_article_ids;
}