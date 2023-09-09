<?php
// Start the session
session_start();

// Include the recommend.php script
require_once 'recommend.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Recommended Articles</title>
</head>

<body>
    <h1>Recommended Articles</h1>
    <ul>
        <?php
        if (isset($_SESSION['recommended_articles'])) {
            $recommended_articles = $_SESSION['recommended_articles'];

            foreach ($recommended_articles as $article) {
                echo "<li>";
                echo "<h2>{$article['title']}</h2>";
                echo "<p>Category: {$article['category']}</p>";
                // Add more article details as needed
                echo "</li>";
            }
        } else {
            echo "No recommended articles available.";
        }
        ?>
    </ul>
</body>

</html>