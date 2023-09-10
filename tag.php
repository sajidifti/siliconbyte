<?php
session_start();


if (!isset($_GET['tag']) || empty($_GET['tag'])) {
    // Redirect to the login page or display a message
    $error = "ভুল লিংক।";
    header("Location: index.php?error=" . urlencode($error));
    exit();
} else {

    $categoryBangla = $_GET['tag'];
}


?>
<!-- Header -->
<?php

include_once('header.php');

include_once('message.php');

?>

<!-- contact start-->
<section class="articles">
    <div class="container">
        <!-- 1st row-->
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="c_title text-center">
                    <h1 class="c_h1 yellow form-title">
                        <?php

                        echo $categoryBangla;

                        ?>
                    </h1>
                    <p class="c_p ash">
                        <?php

                        echo $categoryBangla;

                        ?> সংক্রান্ত সকল খবর পড়ুন
                    </p>
                </div>
            </div>
        </div>
        <!-- 2nd row-->
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            // Include the database connection file
            include 'db-connection.php';

            // Check if the category_id is provided in the URL
            if (isset($_GET['tag'])) {
                $tag = $_GET['tag'];

                // Query to retrieve articles of the specified category
                $sql = "SELECT A.article_id, A.title, A.summary, A.content, A.article_photo, A.DATETIME, A.category, A.views, A.user_id
FROM Articles A
INNER JOIN Article_Tags AT ON A.article_id = AT.article_id
INNER JOIN Tags T ON AT.tag_id = T.tag_id
WHERE T.tag_name = ?
ORDER BY A.DATETIME DESC"; // Adjust the ORDER BY clause as needed
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("s", $tag);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Check if there are articles in the specified category
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Extract data from the current row
                            $article_id = $row['article_id'];
                            $title = $row['title'];
                            $content = $row['content'];
                            $article_photo = $row['article_photo'];
                            $datetime = $row['DATETIME'];

                            // Format the datetime
                            $formatted_datetime = date("j/n/Y H:i", strtotime($datetime)); // Adjust the date format as needed
            
                            // Limit the content to 300 characters
                            if (mb_strlen($content, 'UTF-8') > 200) {
                                $limited_content = mb_substr($content, 0, 200, 'UTF-8');
                                $limited_content .= '...'; // Add ellipsis if content is truncated
                            } else {
                                $limited_content = $content;
                            }

                            // HTML for the card
                            echo '<div class="col">';
                            echo '<a href="readarticle.php?article_id=' . $article_id . '" class="card-link">'; // Replace "details-page.php" with the actual URL of your details page
                            echo '<div class="card h-100 my-card">';
                            echo '<img src="' . $article_photo . '" class="card-img-top" alt="' . $title . '" />';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . $title . '</h5>';
                            echo '<p class="card-text">' . $limited_content . '</p>';
                            echo '</div>';
                            echo '<div class="card-footer">';
                            echo '<small class="text-muted">' . $formatted_datetime . ' এ প্রকাশিত</small>';
                            echo '</div>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        // Handle the case where there are no articles in the specified category
                        echo 'No articles found with this tag.';
                    }

                    // Close the prepared statement
                    $stmt->close();
                } else {
                    // Handle the case where the SQL query couldn't be prepared
                    echo 'Error preparing SQL query.';
                }
            } else {
                // Handle the case where the category_id is not provided in the URL
                echo 'Category ID not provided in the URL.';
            }

            // Close the database connection
            $conn->close();
            ?>

        </div>

    </div>
</section>
<!-- contact end-->

<?php

// Include the footer file
include_once('footer.php');

?>


</body>

</html>