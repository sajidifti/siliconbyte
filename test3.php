<!DOCTYPE html>
<html>

<head>
    <title>Recommended Articles by Tags</title>
</head>

<body>
    <h1>Recommended Articles by Tags</h1>
    <ul>
        <?php
        // Start the session
        // session_start();

        // Include the recommend_tags.php script
        require_once 'recommend_tags.php';

        if (isset($_SESSION['recommended_articles_tags'])) {
            $recommended_articles_tags = $_SESSION['recommended_articles_tags'];

            foreach ($recommended_articles_tags as $article) {
                echo "<li>";
                echo "<h2>{$article['title']}</h2>";
                echo "<p>Category: {$article['category']}</p>";
                echo "<p>Tag Name: {$article['tag_name']}</p>";
                // Add more article details as needed
                echo "</li>";
            }
        } else {
            echo "No recommended articles available based on tags.";
        }
        ?>
    </ul>
</body>

</html>